<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'view_number'=>$this->view_number,
            'name_ar'=>$this->ar_name,
            'name_en'=>$this->en_name,
            'image'=>getimg($this->image),
            'sub_categories'=>$this->subCategories
        ];
    }
}
