<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $fillable = ['id','user_id','title','image','details'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
