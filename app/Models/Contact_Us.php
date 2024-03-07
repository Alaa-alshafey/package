<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_Us extends Model
{

    protected $fillable = [
        'name', 'email','phone', 'message','user_id','suggest','issue','contact','type','file'
    ];

    protected $table = 'contact_us';
    public $timestamps = true;
}
