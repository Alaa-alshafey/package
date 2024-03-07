<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\Contact_Us;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('is_admin', 1)->count();
        $clients = User::where('role', 'client')->count();
        $providers = User::where('role', 'provider')->count();
        $countries = Country::all()->count();
        $cities = City::all()->count();
        $regions = Region::all()->count();
        $categories = Category::all()->count();
        $contacts = Contact_Us::all()->count();
        return view('admin.main', ['admins' => $admins, 'clients' => $clients, 'providers' => $providers, 'countries' => $countries, 'cities' => $cities, 'regions' => $regions, 'categories' => $categories, 'contacts' => $contacts]);
    }


    public function getCity($id)
    {
        return cities($id);
    }

    public function getRegion($id)
    {
        return regions($id);
    }

    public function getSubCategory($id)
    {
        return subCategory($id);
    }

    public function getServices($id)
    {
//        dd($id);
        return services($id);
    }

//    public function sendNotification(){
//        $user = User::first();
//
//        $details = [
//            'greeting' => 'Hi Artisan',
//            'body' => 'This is my first notification from ItSolutionStuff.com',
//            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
//            'actionText' => 'View My Site',
//            'actionURL' => url('/'),
//            'order_id' => 101
//        ];
//
//        Notification::send($user, new MyFirstNotification($details));
//
//        dd('done');
//    }
}
