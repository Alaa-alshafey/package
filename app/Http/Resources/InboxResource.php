<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InboxResource extends ResourceCollection
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
            'inbox'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'order_id'=>$q->order_id,
                    'order_status'=>$q->order->status,
                    'sender_id'=>$q->sender_id,
                    'receiver_id'=>$q->user_id,
                    'sender'=>$q->Sender,
                    'receiver'=>$q->User,
                    'message'=>$q->message,

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
