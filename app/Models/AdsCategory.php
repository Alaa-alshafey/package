<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsCategory extends Model
{
    protected $fillable = ['ar_name','en_name','image'];

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

    public function PUsers()
    {
        return $this->hasMany('\App\Models\User','ads_category')
            ->orderBy('is_top','DESC')->distinct('id')->paginate(15);
    }

    public function UsersIds()
    {
        return $this->belongsToMany('\App\Models\User','ads_category')
            ->distinct('id')->pluck('user_id');
    }
}
