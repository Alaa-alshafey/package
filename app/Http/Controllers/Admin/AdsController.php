<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Intervention\Image\Facades\Image;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ad.index')->with('ad',Ad::all());
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ad.add');
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
            'title'=>'required|string|',
            'image'=>'required|mimes:jpg,jpeg,gif,png',
            'Expired_date'=>'nullable',
            'Url'=>'require',
           
     
        ]);
        //$image = uploader($request,'image');
        $inputs=$request->all();

        $image = $request->file('image');
        $filename = 'image_'.time();

        $image = Image::make($image)
            ->encode('webp', 90)
            ->resize(600, 400)
            ->save(\Storage::disk('public')->path(uploadpath() .'/'.  $filename . '.webp'));

        $inputs['image'] = 'photos/'.$filename . '.webp';




        //$inputs['image']=$image;
       Ad::create($inputs);
         return redirect()->back()->with('success', 'تم  اضافة الاعلان بنجاح !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        return view('admin.ad.edit')->with('ad',Ad::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ad=Ad::find($id);
        $this->validate($request,[
            'image'=>'mimes:jpg,jpeg,gif,png',
            'title'=>'required|string|',
            'Url'=>'string',
        
            ]);
        $inputs=$request->all();
        if($request->hasFile('image'))
        {
            deleteImg($ad->image);
            //$image = uploader($request,'image');
            //$inputs['image']=$image;

            $image = $request->file('image');
            $filename = 'image_'.time();

            $image = Image::make($image)
                ->encode('webp', 90)
                ->resize(600, 400)
                ->save(\Storage::disk('public')->path(uploadpath() .'/'.  $filename . '.webp'));

            $inputs['image'] = $filename . '.webp';


        }
        $ad->update($inputs);
         return redirect()->back()->with('success', 'تم  تعديل الاعلان بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad=Ad::find($id);
        if ($id){
            deleteImg($ad->image);
            $ad->delete();
         return redirect()->back()->with('success', 'تم  حذف الاعلان بنجاح !');
        }
         return redirect()->back()->with('success', 'الاعلان الذى  تحاول حذفه غير موجود !');
    
    
    }
}
