<?php

namespace App\Http\Resources;

use App\Http\Traits\ApiResponses;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MarketResource extends ResourceCollection
{
    use ApiResponses;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'providers'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'title'=>$q->title,
                    'time_count'=>$q->time_count,
                    'attachment'=>getimg($q->attachment),
                    'views'=>$q->views,
                    'description'=>$q->description,
                    'image'=>getimg($q->image),
                     'type'=>$q->type,
                    'user'=>$q->user,

                ];
            })  ,
            'paginate'=>[
//                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url'=>$this->nextPageUrl(),
                'prev_page_url'=>$this->previousPageUrl(),
                'current_page' => $this->currentPage(),
                'total_pages' =>  $this->collection->count() != 0 ? ceil($this->count() /$this->collection->count()):1
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
