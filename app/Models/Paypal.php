<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    //
    protected $fillable=['user_id','payment_method','payment_id','inner_payment_id','status','payer_first_name','payer_last_name','payer_email','payer_id','payer_phone','amount'];

}
