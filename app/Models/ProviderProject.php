<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderProject extends Model
{

    protected $fillable =['title','file_type','file','user_id','price','description'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
