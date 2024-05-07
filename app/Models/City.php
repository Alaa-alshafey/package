<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['ar_name','en_name','country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function regions(){
        return $this->hasMany(Region::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function usersId(){
        return $this->hasMany(User::class)->pluck('id');
    }


    public function name()
    {
        if (app()->getLocale() == 'en')
            return $this->en_name;
        else
            return $this->ar_name;
    }

}
