<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $order=Order::orderBy('id', 'DESC')->get();
        return view('admin.order.index',compact('order'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.add');
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
       
     
        ]);

        $inputs=$request->all();
      Order::create($inputs);
            return redirect()->back()->with('success', 'تم اضافة الطلب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id){

        $orders=\App\Models\Order::where('id',$id)->get();
       
    
        return view('admin.order.show',['orders'=>$orders]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.order.edit')->with('order',Order::find($id));

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
        $order=Order::find($id);
        $this->validate($request,[
            'time'=>'required|string|',
            'date'=>'required|string|',
        
            ]);
        $inputs=$request->all();

        $order->update($inputs);
            return redirect()->back()->with('success', 'تم تعديل الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        if ($order){
            $order->delete();
            return redirect()->back()->with('success', 'تم حذف الطلب بنجاح');
        }
            return redirect()->back()->with('error', 'الطلب التي تحاول حذفها غير موجودة');
    }

    public function rates(){
//dd('hi');
        $rates=Order::all();
//        dd('hi');
        return view('admin.order.rates',['rates'=>$rates]);
    }
}
