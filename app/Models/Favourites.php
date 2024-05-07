<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    public function providers()
    {
        return $this->belongsTo(User::class,'provider_id');
    }
}
