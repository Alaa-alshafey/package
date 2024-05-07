<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCat_Event extends Model
{
    //

    protected $table = 'sub_cat_events';

    protected $fillable = ['id','title','cat_event_id','created_at','updated_at'];

    public function CatEvent(){
        return $this->belongsTo(Cat_Event::class,'cat_event_id','id');
    }

    public function Events(){
        $this->hasMany(Event::class,'sub_cat_id','id');
    }


}
