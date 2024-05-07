<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.regions.index')->with('regions',Region::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country=\App\Models\Country::pluck('ar_name','id')->toArray();
        return view('admin.regions.add',['country'=>$country]);
    }

    public function show ($id){

        $cities=\App\Models\City::where('country_id',$id)->orderby('ar_name')->pluck('ar_name','id')->toArray();

        return view('admin.regions.ajax-city',['cities'=>$cities]);

    }


    public function subCat ($id){

        $subCats=\App\Models\SubCat_Event::where('cat_event_id',$id)->pluck('title','id')->toArray();

        return view('admin.regions.ajax-sub_cat',['subCats'=>$subCats]);

    }

    public function cities ($id){

        $cities=\App\Models\City::where('country_id',$id)->orderby('ar_name')->pluck('ar_name','id')->toArray();

        return view('admin.regions.ajax-city2',['cities'=>$cities]);

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
            'city_id'=>'required|string|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);

        $inputs=$request->all();
        Region::create($inputs);
            return redirect()->back()->with('success', 'تم اضافة الحى بنجاح !' ); 

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country=\App\Models\Country::pluck('ar_name','id')->toArray();
        return view('admin.regions.edit',['country'=>$country])->with('region',Region::find($id));
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
        $region=Region::find($id);

        $this->validate($request,[
            'city_id'=>'required|string|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);

        $inputs=$request->all();
        $region->update($inputs);
            return redirect()->back()->with('success', 'تم تعديل الحى بنجاح !' ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region=Region::find($id);
        if ($region){
            $region->delete();
            return redirect()->back()->with('success', 'تم حذف الحى بنجاح !' ); 
        }
            return redirect()->back()->with('success', 'الحى التي تحاول حذفه غير موجودة!' ); 
    }
}
