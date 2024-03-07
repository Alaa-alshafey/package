<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    //

    public function transactions(){
        return $this->hasMany('App\Models\Transaction','payment_id');
    }
}
