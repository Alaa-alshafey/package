<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\FCMOperation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    use FCMOperation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications  = Notification::all();
        return view('admin.notifications.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notifications.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        if($request['notification_target'] == 'client')
            $users = User::where('role','client')->get();
        elseif($request['notification_target'] == 'provider')
            $users = User::where('role','provider')->where('is_admin','!=','1')->get();
        elseif($request['notification_target'] == 'all_users')
            $users = User::where('is_admin','!=','1')->get();

//        dd($users);

        $details = [
            'title' => $request['notification_title'],
            'body' => $request['notification_body'],
//            'order_id' => 101
        ];
//        dd($details);
        foreach ($users as $user) {
            if ($user->fcm_token_android) {
               sendNotifications($request['notification_title'], $request['notification_body'], $user->fcm_token_android, ['type' => 'general', 'data' => ['title' => $request['notification_title'], 'body' => $request['notification_body']]], false);
            }
                if ($user->fcm_token_ios)
                {
                    $this->notifyByFirebase( $request['notification_title'],$request['notification_body'],$user->fcm_token_ios,['type'=>'general','data'=>[]],true);
                }
            //            Notification::send($user, new AdminNotify($details));
        }
        return redirect()->back()->with('success','تم ارسال الاشعار بنجاح');
//        dd('done');
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
    }
}
