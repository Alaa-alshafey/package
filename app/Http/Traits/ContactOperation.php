<?php


namespace App\Http\Traits;


use App\Contact;
use App\User;
use Hash;
use Illuminate\Http\Request;

trait ContactOperation
{
   public function RegisterContact($request)
  {
      $inputs = $request->all();
      //return Contact::create($inputs);
  }

}