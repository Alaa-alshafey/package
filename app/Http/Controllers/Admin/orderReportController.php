<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class orderReportController extends Controller
{
    public function index(){
        $orders=Order::orderBy('id', 'DESC')->get();
        return view('admin.order.report')->with('orders',$orders);
    }
    public function filter(Request $request){
        $this->validate($request,[
            'start'=>'date',
            'end'=>'date',
        ]);

        $start = $request['start'];
        $end = $request['end'];

        $orders =Order::whereBetween('created_at',[$start,$end])->orderBy('id', 'DESC')->get();

        return view('admin.order.report',compact('orders'));

    }
}
