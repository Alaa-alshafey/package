<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['ar_name','en_name','image','sub_category_id'];

    
    public function orders()
    {
        return $this->hasMany('App\Orders','orders');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function name()
    {
        if (app()->getLocale() == 'en')
            return $this->en_name;
        else
            return $this->ar_name;
    }
}
