<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategories.index')->with('categories',SubCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=\App\Models\Category::pluck('ar_name','id')->toArray();
        return view('admin.subcategories.add',['categories'=>$categories]);
    }

    public function show ($id){

        $sub_categories=\App\Models\SubCategory::where('category_id',$id)->get();
        return view('admin.subcategories.ajax-sub-categories',['sub_categories'=>$sub_categories]);
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
            'category_id'=>'required|integer|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);
        //$image = uploadImageWithCompress($request,'image',263,263);
        $inputs=$request->all();

        $image = $request->file('image');
        $filename = 'image_'.time();

        // $image = Image::make($image)
        //     ->encode('webp', 90)
        //     ->resize(200, 200)
        //     ->save(\Storage::disk('public')->path(uploadpath() .'/'.  $filename . '.webp'));


        $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        Storage::disk('public')->put($filePath, File::get($image));

        $inputs['image'] = 'photos/'.$filename . '.webp';

        //$inputs['image']=$image;
        SubCategory::create($inputs);
            return redirect()->back()->with('success', 'تم اضافة القسم بنجاح !' ); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=\App\Models\Category::pluck('ar_name','id')->toArray();

        return view('admin.subcategories.edit',['categories'=>$categories])->with('category',SubCategory::find($id));
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
        $category=SubCategory::find($id);
        $this->validate($request,[
            'image'=>'mimes:jpg,jpeg,gif,png',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);
        $inputs=$request->all();
        if($request->hasFile('image'))
        {
            deleteImg($category->image);
            //$image = uploadImageWithCompress($request,'image',263,263);
            //$inputs['image']=$image;

            $image = $request->file('image');
            $filename = 'image_'.time();

            $filePath = 'photos/' . $filename . '.webp';
        
            // Save the original image to the storage
            Storage::disk('public')->put($filePath, File::get($image));
            
            $inputs['image'] = 'photos/'.$filename . '.webp';
    
        }
        $category->update($inputs);
         
            return redirect()->back()->with('success', 'تم تعديل القسم بنجاح !' ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=SubCategory::find($id);

        if ($category){
            deleteImg($category->image);
            $category->delete();
            return redirect()->back()->with('success', 'تم حذف القسم بنجاح !' ); 
        }

            return redirect()->back()->with('success', 'القسم التي تحاول حذفه غير موجودة' ); 
    }
}
