<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = ['ar_name','en_name','city_id'];

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function name()
    {
        if (app()->getLocale() == 'en')
            return $this->en_name;
        else
            return $this->ar_name;
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function usersId(){
        return $this->hasMany(User::class)->pluck('id');
    }



}
