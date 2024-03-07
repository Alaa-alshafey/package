<?php

namespace App\Http\Resources;

use App\Http\Traits\ApiResponses;
use Illuminate\Http\Resources\Json\JsonResource;

class chatSingle extends JsonResource
{
    use ApiResponses;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


       return [
           'order_id'=>$this->order_id,
           'chat_id'=>$this->id,
           'message'=> $this->message,
           'sender_id'  => $this->sender->id,
           'sender_name'  => $this->sender->name,
           'sender_image'  => getimg($this->sender->image),
           'receiver_id'  => $this->receiver->id,
           'receiver_name'  => $this->receiver->name,
           'receiver_image'  => getimg($this->receiver->image),

       ];
    }
}
/**
 * 'user_to_id'=>$q->message_to,
'user_to_name'=>$q->user_to->first_name.' '.$q->user_to->last_name,
'user_to_role'=>$q->user_to->role,
'user_from_id'=>$q->message_from,
'user_from'=>$q->user_from->first_name.' '.$q->user_from->last_name,
'user_from_role'=>$q->user_from->role,
'message'=>$q->message,
'created_at'=>$q->created_at->format('Y-d-m h:i')
 */