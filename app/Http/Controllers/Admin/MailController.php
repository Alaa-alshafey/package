<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\FCMOperation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendMessage;
use App\Jobs\SendEmailJob;
use App\Http\Resources\CategoryResource;
use App\Models\SubCategory;


class MailController extends Controller
{
    use FCMOperation;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.send.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//     public function store(Request $request)
//     {

//         $this->validate($request,[
//             'send_target'   => 'required|in:client,provider,all_users',
//             'send_type'     => 'required|in:sms,email,all',
//             'send_body'     => 'required',
//         ]);
//         if($request['send_target'] == 'client')
//             $users = User::where('role','client')->
//             where('is_admin','!=','1')->get();
//         elseif($request['send_target'] == 'provider')
//             $users = User::where('role','provider')
//                 ->where('is_admin','!=','1')->get();
//         elseif($request['send_target'] == 'all_users')
//             $users = User::where('is_admin','!=','1')->get();

//     //   dd($users);


//         $sendType = ($request->get('send_type'));

//         $message  = $request->get('send_body');



//         if ($sendType == 'sms'){

//             foreach ($users as $user){


//                 $MsgID = rand(1,99999);

//                 $result =sendSMS($message, $user->phone,$MsgID);
//             }

//         }elseif ($sendType == 'email'){

//             foreach ($users as $user){

//                 /*Mail::send('emails.sheari_order', $message, function($message) {
//                     $message->to('sheari@hotmail.com', 'تفاصيل طلب جديد في باكيج')->subject
//                     ('تفاصيل طلب جديد في باكيج');
//                     $message->from('info@sheari.net','Package');
//                 });*/
//             }

//         }

//         elseif ($sendType == 'all'){

//             // send sms and email



//             foreach ($users as $user){
//                 if($user->is_admin != 1){
//                 $MsgID = rand(1,99999);
//                 $result =sendSMS($message, $user->phone,$MsgID);


//                 };


//             }

//         }

//             return redirect()->back()->with('success', 'تم ارسال الرسالة النصية بنجاح' );
// //        dd('done');
//     }

    public function store(Request $request)
    {
        $this->validate($request,[
            'send_target'   => 'required',
            'send_type'     => 'required|in:sms,email,all',
            'send_body'     => 'required',
        ]);



        $sendTarget = $request['send_target'];
        $sendType = $request['send_type'];
        $message = $request['send_body'];

        if($sendTarget == "providerTypes"){
            if(!empty($request['type'])){

                $sub_categories = SubCategory::where('category_id', $request['type'])->get();


                $userIds = collect(); // Initialize an empty collection for user_ids

                foreach ($sub_categories as $sub_category) {
                    // Retrieve user_ids for each sub-category and merge them into the $userIds collection
                    $userIds = $userIds->merge($sub_category->UsersIds());
                }

                $users = User::whereIn('id',$userIds)->get();

            }else{

                return redirect()->back()->with('error', 'يجب ان تختار نوع القسم');

            }
        }elseif($sendTarget == "providerAds"){
            if(!empty($request['type'])){
                $users = User::query();

                $users->where('role','=','provider');
                $users->where('ads_category','!=',null);
                $users->when(isset($request['ads_category']),function ($q) use ($request) {
                    if($request['ads_category']!=''){

                        return $q->where('ads_category',$request['type']);
                    }
                });
                $users = $users->get();
            }else{


                return redirect()->back()->with('error', 'يجب ان تختار نوع الاعلان');

            }



        }else{
            $usersQuery = User::where('is_admin', '!=', '1');

            switch ($sendTarget) {
                case 'client':
                    $usersQuery->where('role', 'client');
                    break;
                case 'provider':
                    $usersQuery->where('role', 'provider');
                    break;

                case 'all_users':
                    // No need to add any extra condition
                    break;
                default:
                    // Handle invalid send_target
                    return redirect()->back()->with('error', 'Invalid send target');
            }

            $users = $usersQuery->get();


        }

        foreach ($users as $user) {
            if ($sendType == 'sms' || $sendType == 'all') {
                // Dispatch SendMessage to send SMS
                SendMessage::dispatch($user->phone, $message)->onQueue('sms');
            }

            if ($sendType == 'email' || $sendType == 'all') {
                // Dispatch SendEmailJob to send Email
                SendMessage::dispatch($user->phone, $message)->onQueue('sms');
            }
        }

        return redirect()->back()->with('success', 'تم ارسال الرسالة النصية بنجاح' );
    }

    public function selectcategoryTypes(Request $request){

        if(isset($_GET['providerTypes'])){
            $categories = \App\Models\Category::select('id','ar_name')->where('status',1)->get();

        }else{

            $categories = \App\Models\AdsCategory::select('id','ar_name')->get();

        }
        return response()->json($categories);
    }

}
