<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationsResource;
use App\Http\Resources\QualificationsResource;
use App\Http\Resources\SingleQualificationResource;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\QualificationOperation;
use App\Models\Qualification;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QualificationController extends Controller
{
    use ApiResponses,QualificationOperation;


    public function index()
    {
        $qalfications = Qualification::where('user_id',auth()->user()->id)->paginate($this->paginateNumber);
        $qalfications = new QualificationsResource($qalfications);
        return $this->apiResponse($qalfications);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return $this->notFoundResponse();
        $qalfications = Qualification::where('user_id',$id)->paginate($this->paginateNumber);
        $qalfications = new QualificationsResource($qalfications);
        return $this->apiResponse($qalfications);
    }

    public function store(Request $request)
    {
        $request['user_id'] =auth()->user()->id;
        $rules = [
            'name'    =>'required|string|max:191',
            'degree'  =>'required|string|max:191',
            'image'   =>'required|image|mimes:jpg,jpeg,gif,png',
            'date'   =>'required|string|max:191',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $qualification =$this->RegisterQualification($request);
        $qualification = new SingleQualificationResource($qualification);

        if ($qualification) {return $this->createdResponse($qualification);}
        $this->unKnowError();
    }

    public function update(Request $request,$id)
    {
        $qualification = Qualification::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$qualification) return $this->notFoundResponse();

       $rules = [
            'name'    =>'required|string|max:191',
            'degree'  =>'required|string|max:191',
            'image'   =>'sometimes|image|mimes:jpg,jpeg,gif,png',
            'date'   =>'required|string|max:191',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $this->UpdateQualification($qualification,$request);
        $qualification = new SingleQualificationResource($qualification);
        if ($qualification) {return $this->apiResponse($qualification);}
        $this->unKnowError();
    }

    public function destroy($id)
    {
        $qualification = Qualification::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$qualification) return $this->notFoundResponse();
        $qualification->delete();
        return $this->apiResponse(__('messages.success_delete'));
        }
}
