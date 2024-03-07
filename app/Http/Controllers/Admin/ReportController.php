<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $reports = Report::orderBy('id','DESC')->get();

        return view('admin.reports.index',compact('reports'));



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
        $report = Report::find($id);

        return view('admin.reports.show',compact('report'));
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

        $report = Report::find($id);

        if($report->delete()){
            return redirect()->back()->with('success', 'تم حذف التقرير بنجاح !' ); 

        };

            return redirect()->back()->with('success', 'لم يتم حذف التقرير  !' ); 

    }


    public function activeStar($id){
        $report = Report::find($id);

        $user = User::where('id',$report->user_id)->first();

        if($user){
            $user->is_special = 1;
            $user->save();
            return redirect()->back()->with('success', 'تم تفعيل عضوية التميز للمستخدم' ); 

        }else{
            return redirect()->back()->with('warning', 'اختر مستخدم صحيح' ); 
        }
    }


    public function activeCommission($id){
        $report = Report::find($id);

        $user = User::where('id',$report->user_id)->first();

        if($user){

            $user->commission = 0.00;

            $user->save();

            return redirect()->back()->with('success', 'تم اعادة الحساب للقيمة صفر وليس لة عمولة الان' ); 

        }else{
            return redirect()->back()->with('warning', 'اختر مستخدم صحيح' ); 
        }
    }
}
