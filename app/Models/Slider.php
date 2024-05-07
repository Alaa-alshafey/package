<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Slider
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider query()
 * @mixin \Eloquent
 */
class Slider extends Model
{
    protected $fillable = [
        'image','name'
    ];

    public function name()

    {
        if (app()->getLocale() == 'en')
            return $this->name;
        else
            return $this->name;
    }



}
