<?php

namespace App\Http\Resources;

use App\Http\Traits\ApiResponses;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProviderResource extends ResourceCollection
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

                // Decode HTML entities
                $decodedString = html_entity_decode($q->bio, ENT_QUOTES | ENT_HTML5);

// Remove tags using regular expressions
                $cleanString = preg_replace('/<[^>]*>/', '', $decodedString);

// Extract numbers and words
                $matches = [];
                preg_match_all('/[\p{L}\p{N}]+/u', $cleanString, $matches);
                $result = implode(' ', $matches[0]);

                $result = str_replace('nbsp','',$result);

                return [
                    'id'=>$q->id,
                    'name'=>$q->name,
                    'email'=>$q->email,
                    'phone'=>$q->phone,
                    'bio'=>$result,
                    'rate'=>$q->rate(),
                    'job'=>$q->job,
                    'isOnline'=>$q->is_online ? true : false,
                    'image'=>getimg($q->image),
                    'experience_years'=>$q->experience_years,
                    'nationality'=>$q->nationality,
                    'gender'=>$q->gender,
                    'city_name' => $q->City->name(),
                    'country_name' => $q->City->country->name(),
                    'discount' => $q->discount,
                    'emp_no' => $q->emp_no,
                    'created_year'    => $q->getCreatedAttribute(),
                    'commerical_no' => $q->commerical_no,
                    'map' => $q->map,
                    'delivery' => $q->delivery,
                    'lat' => $q->lat,
                    'lng' => $q->lng,
                    'ads_category'=>$q->ads_category,
                    'charitable' => $q->charitable,
                    'provider_type' => $q->provider_type,
                    'provider_company_type' => $q->provider_company_type,
                    'is_special' => $q->is_special,
                    'registration' => $q->registration,
                    'sub_categories' => $q->SubCategories,
                    'providerCount' => count($q->providerCount),
                    'orderCount'    => $q->orders()->count(),
                    'is_top' => $q->is_top,
                    'is_active' => $q->is_active,
                ];
            }),

            'paginate'=>[
                'total' => $this->total(),
                'last_page' => $this->lastPage(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url'=>$this->nextPageUrl(),
                'prev_page_url'=>$this->previousPageUrl(),
                'current_page' => $this->currentPage(),
                'total_pages' =>  $this->collection->count() != 0 ? ceil($this->count() / $this->collection->count()):1
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
