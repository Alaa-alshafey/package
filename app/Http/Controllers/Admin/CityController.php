<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cities.index')->with('cities',City::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=\App\Models\Country::pluck('ar_name','id')->toArray();
        return view('admin.cities.add',['countries'=>$countries]);
    }

    public function show (){
        return "show";
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
            'country_id'=>'required|string|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);

        $inputs=$request->all();
        City::create($inputs);
            return redirect()->back()->with('success', 'تم اضافة المدينة');

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
        return view('admin.cities.edit',['countries'=>$countries])->with('city',City::find($id));
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
        $city=City::find($id);
        $this->validate($request,[
            'country_id'=>'required|string|',
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
            ]);
        $inputs=$request->all();

        $city->update($inputs);
            return redirect()->back()->with('success', ' تم تعديل المدينة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city=City::find($id);
        if ($city){
            $city->delete();
            return redirect()->back()->with('success', ' تم حذف المدينة بنجاح');
        }
            return redirect()->back()->with('error', ' المدينة التى تحاول حذفها غير موجودة');
    }
}
