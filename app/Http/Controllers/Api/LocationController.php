<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationsResource;
use App\Http\Traits\ApiResponses;
use App\Models\Region;

class LocationController extends Controller
{
    use ApiResponses;


    public function GetAllContries()
    {
        $countries = Country::all();
        $countries = LocationsResource::collection($countries);
        return $this->apiResponse($countries);
    }


    public function GetCitiesByCountry($country_id)
    {
        $cities = City::where('country_id',$country_id)->orderBy('ar_name')->get();
        $cities = LocationsResource::collection($cities);
        return $this->apiResponse($cities);
    }


    public function GetRegionsByCity($city_id)
    {
        $regions =  Region::where('city_id',$city_id)->get();
        $regions =  LocationsResource::collection($regions);
        return $this->apiResponse($regions);
    }


}
