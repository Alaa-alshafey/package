<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Activity;
use Illuminate\Http\Request;
use \Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sliders=Slider::all();
        return view('admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.sliders.create');
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
            'name'=>'required|string',
            'image_for' => 'required',
            'image'=>'required|mimes:jpg,jpeg,gif,png'
        ]);

        //$image=uploadImageWithCompress($request,'image',1200,500);
        $inputs=$request->all();
        //$inputs['image']=$image;

        $image = $request->file('image');
        $filename = 'image_'.time();
        $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        Storage::disk('public')->put($filePath, File::get($image));
        
        $inputs['image'] = 'photos/'.$filename . '.webp';


        Slider::create($inputs);


            return redirect()->back()->with('success', 'تم حفظ السلايدر بنجاح' ); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit( $slider)
    {
         $slider= Slider::find($slider);
        return view('admin.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $slider)
    {
        $slider= Slider::find($slider);
        $this->validate($request,[
            'name'=>'required|string',
            'image_for' => 'required',
            'image'=>'required|mimes:jpg,jpeg,gif,png'
        ]);
        $inputs=$request->all();
        if ($request->hasFile('image')){
            deleteImg($slider->image);
            //$image = uploadImageWithCompress($request,'image',1200,500);
            //$inputs['image']=$image;
            // remove old image

            $image = $request->file('image');
            $filename = 'image_'.time();

            $filePath = 'photos/' . $filename . '.webp';
        
            // Save the original image to the storage
            Storage::disk('public')->put($filePath, File::get($image));
            
            $inputs['image'] = 'photos/'.$filename . '.webp';
    
        }

        $slider->update($inputs);

            return redirect()->back()->with('success', 'تم تعديل السلايدر بنجاح' ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slider)
    {
        $slider= Slider::find($slider)->delete();

            return redirect()->back()->with('success', 'تم حذف السلايدر بنجاح' ); 

    }
}
