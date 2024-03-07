<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //

    protected $table = 'events';


    protected $fillable = ['id','title','sub_cat_id','image','created_at','updated_at'];


    public function SubCat(){
        return $this->belongsTo(SubCat_Event::class,'sub_cat_id','id');
    }




}
