<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = ['notification_target','notification_title','notification_body','notification_status'];

    public function order(){
        return $this->belongsTo('App\Models\Order','item_id','id');
    }
    public  function  getOrder(){
        if($this->type=="order")
        {
            return $this->order;
        }else{
            return null;
        }
    }
}
