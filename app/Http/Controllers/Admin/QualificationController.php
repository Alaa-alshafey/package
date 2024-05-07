<?php

namespace App\Http\Controllers\Admin;

use App\Models\Qualification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.qualification.index')->with('qualification',Qualification::all());
    
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.qualification.add');
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
        Qualification::create($inputs);
           
            return redirect()->back()->with('success', 'تم اضافة المؤهل بنجاح' ); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.qualification.edit')->with('qualification',Qualification::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $qualification=Qualification::find($id);
        $this->validate($request,[
            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
        
            ]);
        $inputs=$request->all();

        $qualification->update($inputs);
            return redirect()->back()->with('success', 'تم تعديل المؤهل بنجاح' ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qualification=Qualification::find($id);
        if ($qualification){
            $qualification->delete();
            return redirect()->back()->with('success', 'تم حذف المؤهل بنجاح' ); 
        }
            return redirect()->back()->with('success', 'المؤهل التي تحاول حذفه غير موجودة' ); 
    
    }
}
