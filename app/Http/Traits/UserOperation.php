<?php


namespace App\Http\Traits;


use App\Models\Address;
use App\Models\User;
use Hash;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait UserOperation
{
   public function RegisterUser($request,$role)
  {
      //dd($request->all());
     $inputs = Arr::except($request->all(), ['code']);

      if ($request->image != null)
      {
          $image = $request->file('image');
          $filename = 'image_'.time();
          $filePath = 'photos/' . $filename . '.webp';
        
        // Save the original image to the storage
        Storage::disk('public')->put($filePath, File::get($image));
        

          $inputs['image'] = 'photos/'. $filename . '.webp';

          /*if ($request->hasFile('image')) {
              $picture = uploadImageWithCompress($request,'image',150,150);
              $inputs['image'] = $picture;
          }*/
      }

      if ($request->cv != null)
      {
          if ($request->hasFile('cv')) {
              $picture = uploader($request,'cv');
              $inputs['cv'] = $picture;
          }
      }
      if ($request->certifications != null)
      {
         $certifications = multiUploader($request, 'certifications');
          $inputs['certifications'] = json_encode($certifications);
      }




      $phone = $request->phone;

      $checked996 = substr($request->phone,0,3);

      if ($checked996 == "966"){
          $phone = substr($request->phone,3);
      }

      $checked = (substr($phone,0,1));


      if ($checked == "0"){

          $phone = $request->code . substr($phone,1);

      }else{
          $phone = $request->code . $phone;
      }



      $inputs['phone'] = $phone;

      $checkUser = User::where('phone',$phone)->first();

      if ($checkUser){

          return null;
      }


      $inputs['password']=Hash::make($request->password);

      $inputs['role'] = $role;

      $verification_code = mt_rand(1000,9999);
      $inputs['verification_code'] = $verification_code;
      $numbers = $phone;						   	//the mobile number or set of mobiles numbers that the SMS message will be sent to them, each number must be in international format, without zeros or symbol (+), and separated from others by the symbol (,).
      $msg = "تهانينا كود التفعيل الخاص بك من باكيج (Package) هو:  ".$verification_code;
      $MsgID = rand(1,99999);


      try{
          $result=sendSMS($msg, $numbers, $MsgID);
      }catch (\Exception$e){

      }



      return User::create($inputs);
  }

    public function UpdateClientProfile($user,$request)
    {
        $inputs = $request->all();
        if ($request->image != null)
        {
            if ($request->hasFile('image')) {
                $picture = uploader($request,'image');
                $user->update(['image' => $picture]);
            }
        }
        if ($request->certifications != null)
        {
            $certifications = multiUploader($request, 'certifications');
            $inputs['certifications'] = json_encode($certifications);
        }

              if ($request->cv != null)
      {
          if ($request->hasFile('cv')) {
              $pic = uploader($request,'cv');
              $user->update(['cv' => $pic]);
          }
      }
      
        if($request->password != null) {$user->update(['password'=>Hash::make($request->password)]);}
        return $user->update(array_except($inputs,['password','image','cv']));
    }

    public function UpdateClientSetting($user,$request)
    {
        $inputs = $request->all();
        return $user->update($inputs);
    }

    public function UpdateClientLocation($user,$request)
    {
        $inputs = $request->all();
        return $user->update($request->only('lat','lng'));
    }


}