<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['ar_name','en_name','image','category_id'];

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function Users()
    {
        return $this->belongsToMany('\App\Models\User','user_sub_categories')
            ->distinct('id')
            ->where('is_verified',1);
    }
public function PUsers()
{
    return $this->belongsToMany(User::class, 'user_sub_categories', 'sub_category_id', 'user_id');
}


    public function UsersIds()
    {
        return $this->belongsToMany('\App\Models\User','user_sub_categories')
            ->distinct('id')->pluck('user_id');
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function name()
    {
        if (app()->getLocale() == 'en')
            return $this->en_name;
        else
            return $this->ar_name;
    }
}
