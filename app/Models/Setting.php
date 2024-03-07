<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'type', 'ar_value', 'en_value' , 'page', 'slug', 'title'];

    public function value()
    {
        if (app()->getLocale() == 'en')
            return $this->en_value;
        else
            return $this->ar_value;
    }
}
