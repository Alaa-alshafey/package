<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleInboxResource extends JsonResource
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
                    'id'=>$this->id,
                    'order_id'=>$this->order_id,
                    'order_status'=>$this->order->status,
                    'sender_id'=>$this->sender_id,
                    'receiver_id'=>$this->user_id,
                    'sender'=>$this->Sender,
                    'receiver'=>$this->User,
                    'message'=>$this->message,
        ];
    }
}
