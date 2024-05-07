<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cat_Event;
use App\Models\Event;
use App\Models\SubCat_Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCatEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategories_events.index')->with('categories',SubCat_Event::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=\App\Models\Cat_Event::pluck('title','id')->toArray();
        return view('admin.subcategories_events.add',['categories'=>$categories]);
    }

    public function show ($id){

        return redirect()->back();

        //$sub_categories=\App\SubCategory::where('category_id',$id)->get();
        //return view('admin.subcategories.ajax-sub-categories',['sub_categories'=>$sub_categories]);
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
            'cat_event_id'=>'required|integer|',
            'title'=>'required|string|max:50',
        ]);

        $inputs=$request->all();
        SubCat_Event::create($inputs);
        alert()->success('تم اضافة القسم بنجاح !')->autoclose(5000);
        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=\App\Models\Cat_Event::pluck('title','id')->toArray();

        return view('admin.subcategories_events.edit',['categories'=>$categories])->with('category',SubCat_Event::find($id));
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
        $category=SubCat_Event::find($id);
        $this->validate($request,[
            'title'=>'required|string|max:50',
        ]);

        $inputs=$request->all();
        $category->update($inputs);
        alert()->success('تم تعديل القسم بنجاح !')->autoclose(5000);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=SubCat_Event::find($id);

        if ($category){

            $images = Event::where('sub_cat_id',$id)->get();

            foreach ($images as $image){
                $img = $image->image;
                deleteImg($img);
            }

            $category->delete();


            alert()->success('تم حذف القسم بنجاح')->autoclose(5000);
            return back();
        }

        alert()->error('القسم التي تحاول حذفه غير موجودة')->autoclose(5000);
        return back();
    }

}
