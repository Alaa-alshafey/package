<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class providersReportController extends Controller
{
    public function index(){
     $users =User::where('role','provider')->get();
     return view('admin.provider.report')->with('users',$users);
    }
    public function filter(Request $request){
        $this->validate($request,[
            'start'=>'date',
            'end'=>'date',
        ]);

        $start = $request['start'];
        $end = $request['end'];

        $users =User::where('role','provider')->whereBetween('created_at',[$start,$end])->get();

        return view('admin.provider.report',compact('users'));

    }
}
