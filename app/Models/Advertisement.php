<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
   protected $fillable=['title','description','user_id','image','ads_category_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
