<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //

    protected $fillable = [
        'id','file','title_ar','title_en','description_ar','description_en','end_date','banner_type'
    ];


    public function getFileAttribute($file){

        return getimg($file);

    }
}
