<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketSingleResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

             return [
                 'id'=>$this->id,
                 'title'=>$this->title,
                 'time_count'=>$this->time_count,
                 'attachment'=>getimg($this->attachment),
                 'views'=>$this->views,
                 'description'=>$this->description,
                 'image'=>getimg($this->image),
                 'type'=>$this->type,
                 'comments'=>CommentResource::collection($this->comments),
                 'user'=>$this->user,
            ];

    }

}
