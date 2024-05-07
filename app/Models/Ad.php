<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['title','image','attachment','user_id','type','description','time_count','views'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        
        return $this->hasMany(Comment::class,'ads_id')->latest();
    }

}
