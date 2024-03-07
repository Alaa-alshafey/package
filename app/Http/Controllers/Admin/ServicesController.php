<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.services.index')->with('services',Service::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=\App\Category::pluck('ar_name','id')->toArray();
        return view('admin.services.add',['categories'=>$categories]);
    }

    public function show ($id){

        $Service=\App\Service::where('sub_category_id',$id)->pluck('ar_name','id')->toArray();
        return view('admin.services.ajax-sub-categories',['Service'=>$Service]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'required|mimes:jpg,jpeg,gif,png',
            'sub_category_id'=>'required|integer|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);
        $image = uploader($request,'image');
        $inputs=$request->all();
        $inputs['image']=$image;
        Service::create($inputs);
            
            return redirect()->back()->with('success', 'تم اضافة الخدمة بنجاح !' ); 

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=\App\Category::pluck('ar_name','id')->toArray();

        $service=Service::find($id);
        $categoriyId=$service->subCategory->Category->id;
        $subCategories=\App\SubCategory::where('category_id',$categoriyId)->pluck('ar_name','id')->toArray();
        return view('admin.services.edit',['categoriyId'=>$categoriyId,'categories'=>$categories,'subCategories'=>$subCategories])->with('service',$service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service=Service::find($id);
        $this->validate($request,[
            'image'=>'mimes:jpg,jpeg,gif,png',
            'sub_category_id'=>'required|string|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);
        $inputs=$request->all();
        if($request->hasFile('image'))
        {
            deleteImg($service->image);
            $image = uploader($request,'image');
            $inputs['image']=$image;
        }
        $service->update($inputs);
            return redirect()->back()->with('success', 'تم تعديل الخدمة بنجاح !' ); 
    }

    /**services
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service=Service::find($id);
        if ($service){
            deleteImg($service->image);
            $service->delete();
            return redirect()->back()->with('success', 'تم حذف الخدمة بنجاح !' ); 
        }
            return redirect()->back()->with('success', 'الخدمة التي تحاول حذفها غير موجودة' ); 
    }
}
