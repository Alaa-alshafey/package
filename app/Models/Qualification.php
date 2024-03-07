<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = ['ar_name', 'en_name'];


    public function name()
    {
        if (app()->getLocale() == 'en')
            return $this->en_name;
        else
            return $this->ar_name;
    }
}