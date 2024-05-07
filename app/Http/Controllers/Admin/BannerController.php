<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    //


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banners.index')->with('banners',Banner::orderBy('id','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.banners.add');
    }

    public function show ($id){

        return "عرض";

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
            'file' =>'required|mimes:jpg,jpeg,gif,png',
            'title_ar'=>'required|string|',
            'end_date'=>'required|date|after:today',
        ]);

        $inputs=$request->all();
       

        //$image = uploadBanner($request,'file');

        $image = $request->file('file');
        $filename = 'file_'.time();

        $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        Storage::disk('public')->put($filePath, File::get($image));
        
        $inputs['file'] = 'photos/'.$filename . '.webp';

        


        //$inputs['file']=$image;
        Banner::create($inputs);
        //dd($inputs);
         return redirect()->back()->with('success', 'تم  اضافة االبانر بنجاح !');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.banners.edit')->with('banner',Banner::find($id));
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
        $banner=Banner::find($id);

    // Validate the request
    $validator = Validator::make($request->all(), [
         'file' =>'required|mimes:jpg,jpeg,gif,png',
        'title_ar' => 'required|string',
        'end_date' => 'required|date|after:today',
    ]);

    // Check for validation errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
        $inputs=$request->all();
        if($request->hasFile('file'))
        {

            deleteImg($banner->file);
            //$image = uploadBanner($request,'image');
            //$inputs['file']=$image;

            $image = $request->file('file');
            $filename = 'file_'.time();

            $filePath = 'photos/' . $filename . '.webp';
        
            // Save the original image to the storage
            Storage::disk('public')->put($filePath, File::get($image));
                        
            $inputs['file'] = 'photos/'.$filename . '.webp';
            


        }

        
        $banner->update($inputs);
         return redirect()->back()->with('success', ' تم تعديل البانر بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Banner::find($id);

        if ($category){
            deleteImg($category->image);
            $category->delete();
         return redirect()->back()->with('success', 'تم حذف الاعلان بنجاح !');
        }
         return redirect()->back()->with('success', 'البانر التي تحاول حذفه غير موجودة !');
    }


}
