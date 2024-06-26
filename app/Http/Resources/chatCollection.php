<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class chatCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return[
           'chats'=>$this->collection->transform(function ($q){
               return[
                   'order_id'=>$q->order->id,
                   'chat_id'=>$q->id,
                   'message'=> $q->message,
                   'sender_id'  => $q->sender->id,
                   'sender_name'  => $q->sender->name,
                   'sender_image'  => getimg($q->sender->image),
                   'receiver_id'  => $q->receiver->id,
                   'receiver_name'  => $q->receiver->name,
                   'receiver_image'  => getimg($q->receiver->image),
             ];
           }),

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
