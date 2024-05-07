<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['ar_name','en_name','view_number','image','image_price','status'];

    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
    public function name()
    {
        if (app()->getLocale() == 'en')
            return $this->en_name;
        else
            return $this->ar_name;
    }
}
