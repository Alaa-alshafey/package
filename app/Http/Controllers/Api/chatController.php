<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Http\Resources\chatSingle;
use App\Http\Resources\chatCollection;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\FCMOperation;
use App\Models\Inbox;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class chatController extends Controller
{
    use  ApiResponses , FCMOperation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role=='client'){
            $orders=Order::where('user_id',auth()->id())->pluck('id');
            $chats=Chat::whereIn('order_id',$orders)->paginate($this->paginateNumber);
        }else if (auth()->user()->role=='provider'){
            $orders=Order::where('provider_id',auth()->id())->pluck('id');
            $chats=Chat::whereIn('order_id',$orders)->paginate($this->paginateNumber);
        }
        else{
            return $this->apiResponse(null,'error in user role !');
        }
        return $this->apiResponse(new chatCollection($chats));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->all();
        $this->validate($request,[
            'order_id'=>'required|exists:orders,id',
            'message'=>'string|required'
        ]);
        $order=Order::findOrFail($request['order_id']);
        $chat = Chat::where('order_id',$request['order_id'])->first();
        if(!$chat)
       {
         $chat=Chat::Create([
             'order_id'=>$request['order_id']
         ]);
       }
       /* if (auth()->user()->role=='client'){
            $inputs['message_from']=$order->client_id;
            $inputs['message_to']=$order->provider_id;
            $android_token=$order->provider->fcm_token_android;
            $ios_token=$order->provider->fcm_token_ios;
        }else if (auth()->user()->role=='provider'){
            $inputs['message_from']=$order->provider_id;
            $inputs['message_to']=$order->client_id;
            $android_token=$order->client->fcm_token_android;
            $ios_token=$order->client->fcm_token_ios;
        }*/
        $inputs['sender_id']=auth()->id();


        $inputs['chat_id']=$chat->id;
        $android_token=$order->provider->fcm_token_android;
        $ios_token=$order->provider->fcm_token_ios;
        if (auth()->id()!=$order->user_id){
            $android_token=$order->user->fcm_token_android;
            $ios_token=$order->user->fcm_token_ios;
        }
        //notifications for android only as data
        if ($android_token!=null){
        $android_notification=$this->notifyByFirebase('رسالة جديدة',$inputs['message'],array($android_token),[
            'title'=>'رسالة جديدة',
            'message'=>$inputs['message'],
            'order_id'=>$request['order_id'],
            'sender_name'=>auth()->user()->name,
            'type'=>'message'
        ]);
        info($android_notification);
        }

        //notifications for ios only as notification
        if ($ios_token!=null) {
            // $ios_notification = $this->Send($ios_token, 'رسالة جديدة', $inputs['message'], [
            //     'order_id' => $request['order_id'],
            //     'sender_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            //     'type' => 'message'
            // ]);
            
            $this->notifyByFirebase('رسالة جديدة',$inputs['message'],array($ios_token),[
            'title'=>'رسالة جديدة',
            'message'=>$inputs['message'],
            'order_id'=>$request['order_id'],
            'sender_name'=>auth()->user()->name,
            'type'=>'message'
        ],true);
        }

        $message=Message::create($inputs);
        return $this->apiResponse(new chatSingle($chat));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $auth = auth()->user();
       // dd($auth);
        $order=Order::findOrFail($id);
        if($order){
            if($order->user_id == $auth->id || $order->provider_id == $auth->id){

                $chats = Inbox::where('order_id',$order->id)->orderBy('id','ASC')->paginate(10);
                if($chats){
                    $chats = new chatCollection($chats);
                    $data = [
                        'chats' => $chats,
                        'user1_data'    => [
                            'id'        => $order->client->id,
                            'name'        => $order->client->name,
                            'email'        => $order->client->email,
                            'image'        => getimg($order->client->image),
                        ],
                        'user2_data'    => [
                            'id'        => $order->provider->id,
                            'name'        => $order->provider->name,
                            'email'        => $order->provider->email,
                            'image'        => getimg($order->provider->image),
                        ],
                    ];
                    return $this->apiResponse($data);
                }else{
                    $data = [
                        'chats' => $chats,
                        'user1_data'    => [
                            'id'        => $order->client->id,
                            'name'        => $order->client->name,
                            'email'        => $order->client->email,
                            'image'        => getimg($order->client->image),
                        ],
                        'user2_data'    => [
                            'id'        => $order->provider->id,
                            'name'        => $order->provider->name,
                            'email'        => $order->provider->email,
                            'image'        => getimg($order->provider->image),
                        ],
                    ];

                    return response()->json([
                        'status'    => true,
                        'user1_data'    => [
                            'id'        => $order->client->id,
                            'name'        => $order->client->name,
                            'email'        => $order->client->email,
                            'image'        => getimg($order->client->image),
                        ],
                        'user2_data'    => [
                            'id'        => $order->provider->id,
                            'name'        => $order->provider->name,
                            'email'        => $order->provider->email,
                            'image'        => getimg($order->provider->image),
                        ],
                        
                        'msg'       => ' chat is empty'
                    ],200);
                }
            }else{
                return $this->apiResponse(null,'you are not authorized to get this chat details',403);
            }
        }








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
