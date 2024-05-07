<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProviderResource extends JsonResource
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
            'client_name'=>$this->client->name,
            'client_id'=>$this->client->id,
            'client_image'=>getimg($this->client->image),
            'provider_name'=>$this->provider->name,
            'provider_id'=>$this->provider->id,
            'provider_image'=>getimg($this->provider->image),
        ];

    }

}
