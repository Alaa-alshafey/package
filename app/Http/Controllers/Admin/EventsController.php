<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::all();

        return view('admin.events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories=\App\Models\Cat_Event::pluck('title','id')->toArray();
        $sub_categories=\App\Models\SubCat_Event::pluck('title','id')->toArray();


        return view('admin.events.add',compact('categories','sub_categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            // 'sub_cat_id'=>'required|integer',
            'title'=>'required|string|max:50',
            'image' => 'required|mimes:jpg,jpeg,gif,png'
        ]);

        $imageFile = $request->file('image');

        // Generate a unique file name
        $fileName = time() . '.' . $imageFile->getClientOriginalExtension();
    
        // Specify the file path
        $filePath = 'photos/' . $fileName;
    
        // Store the file in the public disk
        Storage::disk('public')->put($filePath, File::get($imageFile));
    
        $inputs = $request->all();

        $inputs['image']    = $filePath;

        Event::create($inputs);

            return redirect()->back()->with('success', 'تم اضافة البطاقة بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        $event = Event::find($id);
        $categories=\App\Models\Cat_Event::pluck('title','id')->toArray();
        return view('admin.events.edit',compact('event','categories'));

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
        //
        $event = Event::find($id);
        $this->validate($request,[
            'image'=>'mimes:jpg,jpeg,gif,png',
            'title'=>'required|string|max:50',
            'sub_cat_id'=>'required',
        ]);



        $inputs = $request->all();

        if($request->hasFile('image')){
            deleteImg($event->image);
            $image = uploadImageWithCompress($request ,'image',1000,700);
            $inputs['image']    = $image;
        }


        $event->update($inputs);

            return redirect()->back()->with('success', 'تم تعديل البطاقة بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $category=Event::find($id);

        if ($category){

            deleteImg($category->image);

            $category->delete();
            return redirect()->back()->with('success', 'تم حذف البطاقة بنجاح ');
        }

            return redirect()->back()->with('error', 'البطافة التي تحاول حذفها غير موجودة ');

    }
}
