<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inbox;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index(){
        $chats = Inbox::all();
        return view('admin.chats.index',compact('chats'));
    }
}
