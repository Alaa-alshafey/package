<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationResource extends ResourceCollection
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
            'notifications'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'type'=>$q->type,
                    'title'=>$q->title,
                    'order_id'=>$q->item_id,
                    'order'=>$q->getOrder(),
                    'user_name'=>$q->getOrder()!==null?$q->getOrder()->user->name:"",
                     'provider_image' => ($q->getOrder() !== null && $q->getOrder()->provider !== null) ? getimg($q->getOrder()->provider->image) : "",
                    'user_image'=>($q->getOrder()!==null)?getimg($q->getOrder()->user->image):"",
                    'notification_status'   => getNotificationImage($q->type,$q->notification_status),
                    'created_at'=>$q->created_at,
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
