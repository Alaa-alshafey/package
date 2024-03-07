<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['title','category_id','important','expected_time','expected_money',
        'attachment','time',
        'date','lng','lat','for','rate','comment','status','user_id','provider_id',
        'discount','price_after_discount',
        'service_id','details','failed_reason'];


    public function client()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault(['name'=>'غير موجود']);
    }

    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'Service_id');
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }

    public function messages(){
        return $this->hasMany(Message::class,'order_id','id');
    }
}
