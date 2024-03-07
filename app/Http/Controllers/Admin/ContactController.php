<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact_Us;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts =Contact_Us::orderBy('id', 'DESC')->get();


        return view('admin.contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact =Contact_Us::findOrFail($id);


        return view('admin.contact.show',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Contact=Contact_Us::find($id);
        if ($Contact){
            $Contact->delete();
            return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح ');
        }
            return redirect()->back()->with('error', 'الرسالة التي تحاول حذفها غير موجودة ');
    }
}
