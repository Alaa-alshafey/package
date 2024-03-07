<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\User;
use App\Models\UserSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Storage;
use File;
use Illuminate\Support\Arr;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client.index')->with('users', User::where('role', 'client')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = \App\Models\Country::pluck('ar_name', 'id')->toArray();
        //$categories=\App\Category::pluck('ar_name','id')->toArray();
        return view('admin.client.add', ['countries' => $countries]);
    }

    public function show($id)
    {

        $regions = \App\Models\Region::where('city_id', $id)->pluck('ar_name', 'id')->toArray();

        return view('admin.regions.ajax-region', ['regions' => $regions]);

    }

    /*
     * client show using id
     * */

    public function showClient($id)
    {

        // categories and sub categories
        $client = User::find($id);

        $categories = Category::all();
        return view('admin.client.show', compact('client', 'categories'));

    }

    public function changePermission(Request $request){


        $this->validate($request, [
            'id' => 'required',
            'provider_type' => 'required',
            'provider_company_type' => 'nullable',
            // 'category_id' => 'required',
            // 'ads_category' => 'nullable',
        ]);


        $provider  = User::find($request->id);

        $provider->role = 'provider';
        $provider->provider_type = $request->provider_type;
        $provider->provider_company_type = $request->provider_company_type;
        $provider->ads_category = $request->ads_category ?? 0;


        if($request->sub_categories){
            foreach ($request->sub_categories as $sub_category){

                $usersub=new UserSubCategory();
                $usersub->user_id=$provider->id;
                $usersub->sub_category_id=$sub_category;
                $usersub->save();
            }
        }

        $provider->save();
         return redirect()->back()->with('success','تم تغيير العضوية الى مزود الخدمة');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'name' => 'required|string|',
            'email' => 'required||string|email|max:255|unique:users',
            'phone' => 'required||string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $inputs = $request->all();

        $image = $request->file('image');
        $filename = 'image_'.time();

        $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        Storage::disk('public')->put($filePath, File::get($image));
        
        $inputs['image'] = 'photos/'.$filename . '.webp';

        //$inputs['image'] = $image;
        $inputs['is_admin'] = 0;
        $inputs['role'] = 'client';
        $inputs['password'] = Hash::make($request->password);

        User::create($inputs);
            return redirect()->back()->with('error', ' تم اضافة العميل بنجاح !');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = \App\Models\Country::pluck('ar_name', 'id')->toArray();

        return view('admin.client.edit', ['countries' => $countries])->with('user', User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'image' => 'sometimes|mimes:jpg,jpeg,gif,png',
            'name' => 'required|string|',
            'email' => 'nullable||string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable||numeric|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $inputs = $request->all();
        if ($request->image != null) {
            dd($request->image);
            if ($request->hasFile('image')) {
                //$inputs = $request->all();
                $image = $request->file('image');
                $filename = 'image_'.time();
                $filePath = 'photos/' . $filename . '.webp';
        
                // Save the original image to the storage
                Storage::disk('public')->put($filePath, File::get($image));
                
                $picture = 'photos/'.$filename . '.webp';
        
                $user->update(['image' => $picture]);
            }
        }
        if ($request->password != null) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        $user->update(Arr::except($inputs, ['password', 'image']));
         
         return redirect()->back()->with('error', ' تم تعديل العميل بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->email == 'admin@admin.com') {
            alert()->error('لايمكن حذف الادمن  ');
            return back();
        }
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', ' تم حذف العميل بنجاح !');
        }
            return redirect()->back()->with('error', 'العميل التي تحاول حذفه غير موجودة');
    }

    public function ajaxcountry($id)
    {
        $cities = \App\Models\City::select('ar_name', 'id')->where('country_id', $id)->get();
        return response()->json($cities);
    }

    public function block($id){
        $user = User::find($id);
        $user->update(['is_active'=>'0']);
        return back();
    }

    public function active($id){
        $user = User::find($id);
        $user->update(['is_active'=>'1']);
        return back();
    }

    public function activeStar($id){
        $user = User::find($id);
        $user->update(['is_special'=>'1']);
        return back();
    }

    public function blockStar($id){
        $user = User::find($id);
        $user->update(['is_special'=>'0']);
        return back();
    }

}