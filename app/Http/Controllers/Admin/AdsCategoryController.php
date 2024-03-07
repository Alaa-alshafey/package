<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdsCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class AdsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ads_categories.index')->with('categories',AdsCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.ads_categories.add');
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
            'image'=>'required|mimes:jpg,jpeg,gif,png',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);

        //$image = uploadImageWithCompress($request,'image',300,155);
        $inputs=$request->all();

        $image = $request->file('image');

        $filename = 'image_'.time();

        $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        \Storage::disk('public')->put($filePath, File::get($image));

        $inputs['image'] = 'photos/'.$filename . '.webp';

        //$inputs['image']=$image;
        AdsCategory::create($inputs);
         return redirect()->back()->with('success', 'تم اضافة القسم بنجاح !');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.ads_categories.edit')->with('category',AdsCategory::find($id));
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
        $category=AdsCategory::find($id);

        $this->validate($request,[
            'image'=>'mimes:jpg,jpeg,gif,png',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);
        $inputs=$request->all();

        if($request->hasFile('image'))
        {

            deleteImg($category->image);

            //$image = uploadImageWithCompress($request,'image',260,155);
            //$inputs['image']=$image;
            $image = $request->file('image');
            $filename = 'image_'.time();

            $filePath = 'photos/' . $filename . '.webp';
        
            // Save the original image to the storage
            \Storage::disk('public')->put($filePath, File::get($image));
    
            $inputs['image'] = 'photos/'.$filename . '.webp';
            

        }
       
        $category->update($inputs);
         return redirect()->back()->with('success', 'تم تعديل القسم بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=AdsCategory::find($id);

        if ($category){
            deleteImg($category->image);
            $category->delete();
         return redirect()->back()->with('success', 'تم حذف القسم بنجاح !');
        }
         return redirect()->back()->with('success', 'القسم الذى تريد حذفة غير موجود');
    }
}
