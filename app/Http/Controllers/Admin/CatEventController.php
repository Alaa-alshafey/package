<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cat_Event;
use App\Models\Event;
use App\Models\SubCat_Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories_events.index')->with('categories',Cat_Event::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.categories_events.add');
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
            'title'=>'required|string|max:50',
        ]);

        $inputs=$request->all();
        Cat_Event::create($inputs);
        return redirect()->back()->with('success', ' تم اضافة القسم بنجاح !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.categories_events.edit')->with('category',Cat_Event::find($id));
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
        $category=Cat_Event::find($id);

        $this->validate($request,[
            'title'=>'required|string|max:50',
        ]);
        $inputs=$request->all();


        $category->update($inputs);
        return redirect()->back()->with('success', ' تم تعديل القسم بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Cat_Event::find($id);

        if ($category){
            // get all subcategories and image
            $subCategories = SubCat_Event::where('cat_event_id',$id)->get();

            foreach ($subCategories as $subCategory){

                $images = Event::where('sub_cat_id',$subCategory->id)->get();
                foreach ($images as $image){
                    $img = $image->image;
                    deleteImg($img);
                }
            }

            $category->delete();
            return redirect()->back()->with('success', ' تم حذف القسم بنجاح !');
        }
            return redirect()->back()->with('error', 'القسم التي تحاول حذفه غير موجودة');
    }
}
