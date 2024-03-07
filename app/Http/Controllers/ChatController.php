<?php

namespace App\Http\Controllers;
use App\Chat;
use App\Inbox;
use App\Message;
use App\typing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use URL;
use Illuminate\Support\Str;
class ChatController extends Controller
{

    public function home($id){
        return view('user.chat.home');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        $chat = new Inbox();
        $chat->message = $request->message;
        $chat->sender_id = \auth()->id();
        $chat->user_id = $request->recever;
        $chat->save();

        return back();
    }

    function callmessage($id){
        $user = DB::table('users')->where('id',$id)->first();

        $user->name;
        $auth_id=Auth::id();
        $chats = Inbox::where('sender_id',$auth_id)
            ->where('user_id',$id)
            ->Orwhere('user_id',$id)
            ->where('sender_id',$auth_id)
            ->get();
        foreach($chats as $chat){
            if($chat->sender_id != $auth_id){
                echo '<li class="left clearfix"><span class="chat-img pull-left">
<img src="http://placehold.it/50/55C1E7/fff&text='. mb_substr($user->name , 0, 1) .' " alt="User Avatar" class="img-circle" />
</span>
<div class="chat-body clearfix">
    <div class="header">
        <strong class="primary-font">'.$user->name  . '</strong> <small class="pull-right text-muted">
            <span class="glyphicon glyphicon-time"></span>' . $chat->created_at->diffForHumans() .'</small>
    </div>
    <div class="alert alert-success ">
    '. $chat->message .' </div>
                  </div>
                  </li>';
            }else{
                echo '<li id="'.$chat->id.'" class="right clearfix"><span class="chat-img pull-right">
                <img src="http://placehold.it/50/FA6F57/fff&text='. mb_substr(Auth::user()->name , 0, 1) .'" alt="User Avatar" class="img-circle" />
            </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'. $chat->created_at->diffForHumans() .'</small>
                        <strong class="pull-right primary-font">'.Auth::user()->name  .'</strong>
                    </div>
                    <div class="alert alert-info ">
  <span onclick="deleteMessage('.$chat->id.')" class="close"  aria-label="close">&times;</span>'. $chat->message .' </div>
                </div>
                </li>';
            }
        };
    }

    public function deletemessage($id){
        DB::table('chats')->where('id',$id)
            ->delete();
    }
    public function allMessageView(){
        $url=URL::to('/message/');
        $users = DB::table('users')->get();

        foreach($users as $user){
            if(Auth::id()!=$user->id){

                $message = DB::table('inbox')->where('user_id',Auth::id())
                    ->where('user_id',$user->id)
                    ->orderBy('id','desc')
                    ->first();
                $msgcount = DB::table('inbox')->where('user_id',Auth::id())
                    ->where('sender_id',$user->id)
                    ->get()
                    ->count();

                if($msgcount>0){
                    $msg="(". $msgcount  .")";
                    $start_b='<b>';
                    $end_b='</b>';
                }else{
                    $msg="";
                    $start_b='';
                    $end_b='';
                }
                if(isset($message)){
                    $srtmessage=Str::limit($message->message, 40);
                    echo '
                <li class="left clearfix">
                        <span class="chat-img pull-left">
                        <img alt="User Avatar" class="img-circle" src="http://placehold.it/25/55C1E7/fff&amp;text=U"></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                             <strong class="primary-font">' . $user->name . $msg .'</strong>
                             <p style="color:black">
                             
                            '. $start_b . $srtmessage .$end_b.'
                              
                             </p>
                            </div>
                        
                        </div>
                    </li>                   
                </a>
                
                
                
                
                ';
                }

            }
        }

    }
}