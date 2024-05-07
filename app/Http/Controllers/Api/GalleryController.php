<?php

namespace App\Http\Controllers\Api;


use App\Models\Gallery;
use App\Http\Controllers\Controller;

use App\Http\Resources\GalleryResource;
use App\Http\Resources\SingleGalleryResource;
use App\Http\Resources\SingleServiceResource;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\GalleryOperation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GalleryController extends Controller
{
    use ApiResponses,GalleryOperation;


    public function index()
    {
        $gallaries = Gallery::where('user_id',auth()->user()->id)->paginate($this->paginateNumber);
        $gallaries = new GalleryResource($gallaries);
        return $this->apiResponse($gallaries);
    }



    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return $this->notFoundResponse();
        $gallaries = Gallery::where('user_id',$id)->paginate($this->paginateNumber);
        $gallaries = new GalleryResource($gallaries);
        return $this->apiResponse($gallaries);
    }

    public function store(Request $request)
    {
        $request['user_id'] =auth()->user()->id;
        $rules = [
            'type'    =>'required|string',
            'video'    =>'required_if:type,==,video|url',
            'image'   =>'required_if:type,==,image|image|mimes:jpg,jpeg,gif,png',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $gallary =$this->RegisterGallery($request);
        $gallary = new SingleGalleryResource($gallary);

        if ($gallary) {return $this->createdResponse($gallary);}
        $this->unKnowError();
    }

    public function destroy($id)
    {
        $gallary = Gallery::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$gallary) return $this->notFoundResponse();
        $gallary->delete();
        return $this->apiResponse(__('messages.success_delete'));
        }
}
