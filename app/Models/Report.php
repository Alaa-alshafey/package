<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = 'reports';

    protected $fillable = ['id','user_id','image','type','message'];

    public function user(){

        return $this->belongsTo(User::class);

    }
}
