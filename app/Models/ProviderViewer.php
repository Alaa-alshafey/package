<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderViewer extends Model
{
    //
    protected $fillable = [
        'user_id',
        'user_ip',
        'user_agent',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
