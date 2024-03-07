<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->role == "provider") {
            return [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'role' => $this->role,
                'bio'=> strip_tags(preg_replace('/\r|\n/', '', $this->bio)),
                'is_verified' => $this->is_verified,
                'image' => getimg($this->image),
                 'gender' => ($this->gender == null) ? "" : $this->gender,
                'job' => ($this->gender == null) ? "" : $this->job,
                 'region_name' => $this->Region->name(),
                'city_name' => $this->Region->city->name(),
                'country_name' => $this->Region->city->country->name(),
                'lng' => $this->lng,
                'lat' => $this->lat,
                'nationality'=>$this->nationality,
                'account_maroof'    => $this->account_maroof,
                'account_freelancer'    => $this->account_freelancer,
                'is_active' => $this->is_active,
                ];
        }

        else
            
        {
            return [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'role' => $this->role,
                'bio' => $this->bio,
                'is_verified' => $this->is_verified,
                'image' => getimg($this->image),
                'social'=>['facebook_link'=>($this->facebook_link==null)?"":$this->facebook_link,'instagram_link'=>($this->instagram_link==null)?"":$this->instagram_link],
                'birth_date' => ($this->birth_date == null) ? "" : $this->birth_date,
                'gender' => ($this->gender == null) ? "" : $this->gender,
                'job' => ($this->job == null) ? "" : $this->job,
                'location' => ['lat' => (json_decode($this->location)['lat']  == null) ? "" : (json_decode($this->location)['lat']), 'long' => (json_decode($this->location)['long']  == null) ? "" : (json_decode($this->location)['long'])],
                'region_id' => $this->region_id,
            ];
        }

    }
}
