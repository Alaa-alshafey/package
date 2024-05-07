<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

//        dd($this->isOnline());
        if ($this->role == "provider") {
            return [
                'isOnline'=>$this->is_online ? true : false,
                'id' => $this->id,
                'name' => $this->name,
                'identity' => $this->identity,
                'email' => $this->email,
                'phone' => $this->phone,
                'role' => $this->role,
                'bio'=>strip_tags(preg_replace('/\r|\n/', '', $this->bio)),
//                'cv' => getimg($this->cv),
                'is_verified' => $this->is_verified,
                'image' => getimg($this->image),
                'city_name' => $this->City->name(),
                'city_id' => $this->City->id,
                'country_name' => $this->City->country->name(),
                'country_id' => $this->City->country->id,
                'lng' => $this->lng,
                'lat' => $this->lat,
                'commission' => $this->commission,
//                'service_id' => $this->service_id,
//                'service_price' => $this->service_price,
                'rate' => $this->rate(),
                'discount' => $this->discount,
                'emp_no' => $this->emp_no,
                'created_year'    => $this->getCreatedAttribute(),
                'commerical_no' => $this->commerical_no,
                'map' => $this->map,
                'delivery' => $this->delivery,
                'charitable' => $this->charitable,
                'provider_type' => $this->provider_type,
                'provider_company_type' => $this->provider_company_type,
                'is_special' => $this->is_special,
                'job' => $this->job,
                'category' => $this->SubCategories[0]->category,
                'address' => $this->address,
                'sub_categories' => $this->SubCategories,
//               'certifications' => json_decode($this->certifications),
                'nationality'=>$this->nationality,
                'gender'=>$this->gender,
//                'general_specification'=>$this->general_specification,
//                'nano_specification'=>$this->nano_specification,
                'experience_years'=>$this->experience_years,
                'fcm_token_android' => $this->fcm_token_android,
                'fcm_token_ios'     => $this->fcm_token_ios,
//                'domain' => asset('/'),
                'token' => $this->token,
                'ads_category' => $this->adsCategory,
                'providerCount' => count($this->providerCount),
                'account_maroof'    => $this->account_maroof,
                'account_freelancer'    => $this->account_freelancer,
                'registration' => $this->registration,
                'is_active' => $this->is_active,
                'orderCount'    => $this->orders()->count()
            ];
        }
        else
        {

            return [
                'id' => $this->id,
                'name' => $this->name,
                'identity' => $this->identity,
                'email' => $this->email,
                'phone' => $this->phone,
                'nationality'=>$this->nationality,
                'gender'=>$this->gender,
                'role' => $this->role,
                'is_verified' => $this->is_verified,
                'is_special' => $this->is_special,
                'image' => getimg($this->image),
                'token' => $this->token,
                'lng' => $this->lng,
                'lat' => $this->lat,
                'fcm_token_android' => $this->fcm_token_android,
                'fcm_token_ios'     => $this->fcm_token_ios,
                'city_name' => $this->City->name(),
                'city_id' => $this->City->id,
                'country_name' => $this->City->country->name(),
                'country_id' => $this->City->country->id,
                'created_year'    => $this->getCreatedAttribute(),
                'is_active' => $this->is_active,

            ];
        }
    }

}
