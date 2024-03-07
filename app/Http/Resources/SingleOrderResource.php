<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SingleOrderResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title'=>$this->title,
            'name'=>$this->client->name,
            'user'=>($this->client),
            'provider'=>($this->provider),
            'provider_image'=>getimg($this->provider->image),
            'client_image'=>getimg($this->client->image),
            'details'=>$this->details,
            'status'=>$this->status,
            'full_date'=>$this->created_at->toDateTimeString(),
            //'category_id'=>$this->category_id,
            //'important'=>$this->important,
            //'expected_time'=>$this->expected_time,
            'expected_money'=>$this->expected_money,
            'discount'=>$this->discount,
            'order_icon'   => getOrderImage($this->status),
            'price_after_discount'=>$this->price_after_discount,
            'attachment'=>$this->attachment?getimg($this->attachment):"" ,
            'date'=>$this->date,
            'lng'=>$this->lng,
            'lat'=>$this->lat,
            //'for'=>$this->for,
            'rate'=>$this->rate?$this->rate:0,
            'is_rated'=>$this->rate?1:0,
        ];
    }

}
