<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin.index')->with('users',User::where('is_admin',1)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=\App\Models\Country::pluck('ar_name','id')->toArray();
        $categories=\App\Models\Category::pluck('ar_name','id')->toArray();
        return view('admin.admin.add',['categories'=>$categories,'countries'=>$countries]);
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
            'image'=>'required|image|',
            'name'=>'required|string|',
            'email'=>'required||string|email|max:255|unique:users',
            'phone'=>'required||string|max:255|unique:users',
            'identity'=>'required||string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'job'=>'nullable|string|',
            'gender'=>'nullable|string|',
            'birth_date'=>'nullable|string|date_format:m/d/Y',
            'facebook_link'=>'nullable|string|url',
            'instagram_link'=>'nullable|string|url',
        ]);
        $image = $request->file('image');
        $filename = 'image_' . time();
        $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        Storage::disk('public')->put($filePath, File::get($image));
        
        $inputs=$request->all();
        $inputs['image'] = 'photos/'.$filename . '.webp';
        $inputs['is_admin']=1;
        $inputs['password']=Hash::make($request->password);

        User::create($inputs);
        alert()->success('تم اضافة الادمن بنجاح !')->autoclose(5000);
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
        $countries=\App\Models\Country::pluck('ar_name','id')->toArray();
        $user= User::find($id);
        $country_id=$user->city->country->id;
        $cities=\App\Models\City::where('country_id',$country_id)->pluck('ar_name','id')->toArray();
        $city_id=$user->city->id;
        $regions=\App\Models\Region::where('city_id',$city_id)->pluck('ar_name','id')->toArray();

        return view('admin.admin.edit',['regions'=>$regions,'city_id'=>$city_id,'country_id'=>$country_id,'cities'=>$cities,'countries'=>$countries])->with('user',$user);
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
        $user=User::find($id);

        $this->validate($request,[
            'image'=>'sometimes|image|',
            'name'=>'required|string|',
            'identity'=>'required|string|',
            'email'=>'nullable||string|email|max:255|unique:users,email,'.$user->id,
            'phone'=>'nullable||numeric|unique:users,phone,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'job'=>'nullable|string|',
            'gender'=>'nullable|string|',
            'birth_date'=>'nullable|string|date_format:m/d/Y',
            'facebook_link'=>'nullable|string|url',
            'instagram_link'=>'nullable|string|url',
        ]);

        $inputs = $request->all();
        if ($request->image != null)
        {
            if ($request->hasFile('image')) {
                deleteImg($user->image);
                $picture = uploader($request,'image');
                $user->update(['image' => $picture]);

            }
        }
        if($request->password != null) {$user->update(['password'=>Hash::make($request->password)]);}
        $user->update(array_except($inputs,['password','image']));
        alert()->success('تم تعديل بيانات الادمن بنجاح !')->autoclose(5000);
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
        $user=User::find($id);

        if($user->email=='admin@admin.com'){
            alert()->error('لايمكن حذف الادمن  ');
            return back();
        }
        if ($user){
            deleteImg($user->image);
            $user->delete();
            alert()->success('تم حذف الادمن بنجاح');
            return back();
        }
        alert()->error('الادمن الذى تحاول حذفه غير موجود');
        return back();
    }
}
