<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationsResource;
use App\Http\Resources\QualificationsResource;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\SingleQualificationResource;
use App\Http\Resources\SingleServiceResource;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\ServiceOperation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    use ApiResponses,ServiceOperation;


    public function index()
    {
        $services = Service::where('user_id',auth()->user()->id)->paginate($this->paginateNumber);
        $services = new ServicesResource($services);
        return $this->apiResponse($services);
    }



    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return $this->notFoundResponse();
        $services = Service::where('user_id',$id)->paginate($this->paginateNumber);
        $services = new ServicesResource($services);
        return $this->apiResponse($services);
    }

    public function store(Request $request)
    {
        $request['user_id'] =auth()->user()->id;
        $rules = [
            'name'    =>'required|string|max:191',
            'price'  =>'required|integer',
            'image'   =>'required|mimes:jpg,jpeg,gif,png',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $service =$this->RegisterService($request);
        $service = new SingleServiceResource($service);

        if ($service) {return $this->createdResponse($service);}
        $this->unKnowError();
    }

    public function update(Request $request,$id)
    {
        $service = Service::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$service) return $this->notFoundResponse();

       $rules = [
           'name'    =>'required|string|max:191',
           'price'  =>'required|integer',
           'image'   =>'required|mimes:jpg,jpeg,gif,png',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $this->UpdateService($service,$request);
        $service = new SingleServiceResource($service);
        if ($service) {return $this->apiResponse($service);}
        $this->unKnowError();
    }

    public function destroy($id)
    {
        $service = Service::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$service) return $this->notFoundResponse();
        $service->delete();
        return $this->apiResponse(__('messages.success_delete'));
        }
}
