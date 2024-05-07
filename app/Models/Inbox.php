<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{

    protected $table='inbox';
    protected $fillable = ['order_id','user_id','sender_id','message'];
//
//    public function User()
//    {
//        return $this->belongsTo(User::class,'user_id');
//    }


    public function receiver()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }


    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }


}
