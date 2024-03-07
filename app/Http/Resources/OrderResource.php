<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResource extends ResourceCollection
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
            'orders'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'title'=>$q->title,
                    'name'=>$q->client->name,
                    'user'=>($q->client),
                    'provider'=>($q->provider),
                    'provider_image'=>getimg($q->provider->image),
                    'client_image'=>getimg($q->client->image),
                    'details'=>$q->details,
                    'status'=>$q->status,
                    'full_date'=>$q->created_at->toDateTimeString(),
                    //'category_id'=>$q->category_id,
                    //'important'=>$q->important,
                    //'expected_time'=>$q->expected_time,
                    'expected_money'=>$q->expected_money ,
                    'discount'=>$q->discount,
                    'order_icon'   => getOrderImage($q->status),
                    'price_after_discount'=>$q->price_after_discount,
                    'attachment'=>$q->attachment?getimg($q->attachment):"" ,
                    'lng'=>$q->lng,
                    'lat'=>$q->lat,
                    //'for'=>$q->for,
                    'rate'=>$q->rate?$q->rate:0,
                    'is_rated'=>$q->rate?1:0,
                ];
            })  ,
            'paginate'=>[
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url'=>$this->nextPageUrl(),
                'prev_page_url'=>$this->previousPageUrl(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]
        ];
    }
    public function withResponse($request, $response)
    {
        $originalContent = $response->getOriginalContent();
        unset($originalContent['links'],$originalContent['meta']);
        $response->setData($originalContent);
    }
}
