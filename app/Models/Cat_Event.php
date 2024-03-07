<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat_Event extends Model
{

    //

    protected $table = 'cat_events';

    protected $fillable = ['id','title','created_at','updated_at'];

    public function SubCatEvents(){
        $this->hasMany(SubCat_Event::class,'cat_event_id','id');
    }
}
