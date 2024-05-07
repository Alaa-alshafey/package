<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.country.index')->with('country',Country::all());
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.add');
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
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        ]);

        $inputs=$request->all();
        Country::create($inputs);
        // alert()->success('تم اضافة الدولة بنجاح !')->autoclose(5000);
           
        

            return redirect()->back()->with('success', 'تم اضافة الدولة بنجاح !');

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.country.edit')->with('country',Country::find($id));
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
        $country=Country::find($id);
        $this->validate($request,[
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
            ]);
        $inputs=$request->all();

        $country->update($inputs);
        // alert()->success('تم  !')->autoclose(5000);
            return redirect()->back()->with('success', 'تم تعديل الدولة بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=Country::find($id);
        if ($country){
            $country->delete();
            return redirect()->back()->with('success', 'تم حذف الدولة بنجاح !');
        }
            return redirect()->back()->with('error', 'تم التي تحاول حذفها غير موجودة !');
    }
}
