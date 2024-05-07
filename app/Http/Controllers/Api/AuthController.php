<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SingleUserResource;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\FCMOperation;
use App\Http\Traits\UserOperation;
use App\Notifications\ConfirmationEmail;
use App\Notifications\ValidationEmail;
use App\Models\ProviderViewer;
use App\Models\UserSubCategory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTFactory;
use Illuminate\Support\Facades\Auth;

use JWTAuth;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use \Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use ApiResponses,UserOperation, FCMOperation;

    /**
     * Regular Registration
     *
     * @param Request $request
     * @param null $facebook
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request,$role)
    {
        $request['role'] =$role;
        $rules = [
            'name' =>'required|string|max:191',
            'email'      =>'required|email:max:191|unique:users',
            'code'      =>'required',
            'phone'      =>'required|string|max:191|unique:users',
            'identity'      =>'nullable|string|max:191|unique:users',
            'password'   =>'required|string|max:191|min:6',
            'nationality'   =>'nullable|string|max:191',
            'gender'   =>'nullable|string|max:191|',
            'city_id'   =>'required',
            'sub_categories'          =>'required_if:role,==,provider|array ',
            'sub_categories.*'        =>'required_if:role,==,provider|integer|exists:sub_categories,id',
            'image'     =>'nullable|mimes:jpg,jpeg,gif,png',
            'lng'   =>'nullable|string',
            'lat'   =>'nullable|string',
            'bio'   =>'nullable|string',
            'discount'   =>'nullable|string',
            'emp_no'   =>'nullable|string',
            'creation_year'   =>'nullable|string',
            'map'   =>'nullable|string',
            'delivery'   =>'nullable|string',
            'charitable'   =>'nullable|string',
            'provider_type'   =>'nullable|string',
            'provider_company_type'   =>'required_if:role,==,provider|string',
            'ads_category'   =>'nullable',
            'commerical_no'    => 'nullable',
            'account_maroof'    => 'nullable|in:yes,no',
            'account_freelancer'    => 'nullable|in:yes,no'
        ];



        $validation=$this->apiValidation($request,$rules);

        if($validation instanceof Response){return $validation;}
        if($request['provider_company_type']){
            if($request['provider_company_type']=='LTD'
                || $request['provider_company_type']=='MNC' ){
                $request['is_special']=1;
            }
        }
        /*if($request->hasfile('image')){
            $image = $request->file('image');
            $filename = 'image_'.time();

            $image = Image::make($image)
                ->encode('webp', 90)
                ->resize(150, 150)
                ->save(\Storage::disk('public')->path(uploadpath() .'/'.  $filename . '.webp'));
            dd($image);
            /*
            $image->resize(100, 100, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img=uploadImageWithCompress($request, 'image',150,150);
//                dd($request['image']);
            $data['image']='photos/'.$filename;
//                dd(2);

        }*/
        $user =$this->RegisterUser($request,$role);
        if (!$user){
            $msg = 'قيمة الهاتف مستخدمة من قبل';

            return $this->apiResponse(null,$msg,401);
        }


        $user = User::where('id',$user->id)->first();



        //$user->save();


        if($request->has('sub_categories')){
                foreach ($request['sub_categories'] as $sub)
                {
                    $usersub = new UserSubCategory();
                    $usersub->user_id=$user->id;
                    $usersub->sub_category_id=$sub;
                    $usersub->save();
                }
        }

        $token = JWTAuth::fromUser($user);

        $user['token'] = $token;





        $data = array('code'=>$user->verification_code);

        try{

            Mail::send('emails.verification_code', $data, function($message) use ($user) {
                $message->to($user->email, 'كود التفعيل')->subject
                ('كود التفعيل');
                $message->from('info@sheari.net','Package');
            });

        }catch (\Exception $e){

        }

        try{
            $code_data = $user->verification_code;
            $msq=" تهانينا كود التفعيل الخاص بك من باكيج (Package) هو :  $code_data";
            sendSms($msq,$user->phone,rand(1,99999));
        }catch (\Exception $e){

        }



        $user = new UserResource($user);

        return $this->apiResponse($user);

        /*return \response()->json([
            'status'    => true,
            'user'      => new UserResource($user),
            'message'   => "من فضلك ادخل كود التفعيل المرسل علي الرقم الخاص بك "
        ],200);*/
//        $msq=" Sheari Application Verification code : " . $user->verification_code;
//        sendSms($msq,$user->phone);
        //$token = JWTAuth::fromUser($user);
        //$user['token'] = $token;


        //$user =  new UserResource($user);
//        $user->notify(new ValidationEmail($user));
        //if ($token && $user) {return $this->createdResponse($user);}
        //$this->unKnowError();
    }

    /**
     * Login with a specific user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        $rules = [
            'phone'      =>'required',
            'password'   =>'required|string|max:191',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        if (!$token = JWTAuth::attempt(
            [
                'phone'=>$request->phone,
                'password'=>$request->password
            ]))
        {
            if (!$token = JWTAuth::attempt(
                [
                    'phone'=>$request->phone,
                    'password'=>$request->password
                ]))
                return $this->apiResponse(null,__('messages.wrong_credentials'),406);
        }

        $user = User::where('phone',$request->phone)->first();
        $user->user_token = $token;
        $user->is_online = 1;
        $user->save();

        if(!$user){
            $user = User::where('phone',$request->phone)->first();
        }




//        if ($user->is_verified==0){
////            $user->verification_code=mt_rand(1000,9999);
////            $user->save();
////            $user->notify(new ValidationEmail($user));
////            $user['token'] = $token;
////            $user =  new UserResource($user);
////            return $this->apiResponse($user);
//        }


        $user['token'] = $token;
        $user =  new UserResource($user);
        if ($token && $user) {
            if($user->fcm_token_android)
                $result = $this->notifyByFirebase(' تم التسجيل',
                    $user->name,
                    [$user->fcm_token_android],
                    ['type'=>'','data'=>$user],
                    false);
            if($user->fcm_token_ios)
                $result = $this->notifyByFirebase(' تم التسجيل', $user->name,[$user->fcm_token_ios],
                    ['type'=>'order','data'=>$user],true);


            return $this->apiResponse($user);
        }
        $this->unKnowError();
    }


    public function getFcmToken(){
        $user = auth()->user();
        if($user){
            return \response()->json([
                'status'                => true,
                'message'               => ' fcm token ',
                'fcm_token_android'     => $user->fcm_token_android,
                'fcm_token_ios'         => $user->fcm_token_ios
            ],200);
        }else{
            return \response()->json([
                'status'                => false,
                'message'               => ' required login ',
            ],404);
        }


    }


    public function updateFcmToken(Request $request){
        $user = auth()->user();


        if($user){

            $user->fcm_token_android = $request->fcm_token_android;

            $user->fcm_token_ios = $request->fcm_token_ios;

            $user->device_token = $request->fcm_token_android;

            $user->save();


            return \response()->json([
                'status'                => true,
                'message'               => ' fcm token ',
                'fcm_token_android'     => $user->fcm_token_android,
                'fcm_token_ios'         => $user->fcm_token_ios
            ],200);
        }else{

            return \response()->json([
                'status'                => false,
                'message'               => ' required login ',
            ],404);
        }


    }


    /**
     * Forget Password
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function forget_password(Request $request)
    {
        $phone = $request->phone;

        $checked = (substr($phone,0,1));


        if ($checked == "0"){

            $phone = 966 . substr($phone,1);

        }else{
            $phone = 966 . $phone;
        }


        //$phone = 966 . $request->phone;

        /*$checked996 = substr($request->phone,0,3);

        if ($checked996 == "966"){
            $phone = substr($request->phone,3);
        }

        $checked = (substr($phone,0,1));


        if ($checked == "0"){

            $phone = $request->code . substr($phone,1);

        }else{
            $phone = $request->code . $phone;
        }*/

        $user=User::where('phone',$phone)->first();

        if ($user){
//            $code=GenerateMobileConfirmation();

            $verification_code = mt_rand(1000,9999);

            //$inputs['verification_code'] = $verification_code;
            $numbers = $phone;	//the mobile number or set of mobiles numbers that the SMS message will be sent to them, each number must be in international format, without zeros or symbol (+), and separated from others by the symbol (,).
            $code_data = $verification_code;
            $msg=" كود إعادة تفعيل كلمة السر الخاص بك من باكيج (Package) هو  :  $code_data";
            $MsgID = rand(1,99999);
            sendSMS($msg, $numbers, $MsgID);
            $user->verification_code = $verification_code;
            $user->save();
            $data = array('code'=>$user->verification_code);
            try{
                Mail::send('emails.forget_password', $data, function($message) use ($user) {
                    $message->to($user->email, 'كود لاعادة تفعيل كلمة السر')->subject
                    ('كود لاعادة تفعيل كلمة السر');
                    $message->from('info@sheari.net','Package');
                });
            }catch (\Exception $e){

            }




            return \response()->json([
                'status'    => true,
                'message'   => "تم ارسال كود لاعاده كلمه السر "
            ],200);
            //return $this->apiResponse(__('messages.success_sent'));
        }else{

            return $this->apiResponse('تأكد من البيانات',null,
                '402');

        }
    }

    public function reset_password(Request $request)
    {  $rules = [
        'reset_code'    =>  'required',
        'phone'         =>  'required',
        'code'          =>  'required',
        'password'      =>  'required|confirmed|min:6',
    ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;

        $phone = $request->phone;
        $checked = (substr($phone,0,1));
        if ($checked == "0"){

            $phone = $request->code . substr($phone,1);

        }else{
            $phone = $request->code . $phone;
        }



        $user=User::where('phone', $phone)
            ->where('verification_code', $request['reset_code'])
            ->first();

        if ($user){
            $token = JWTAuth::fromUser($user);
            $user->verification_code=0;
            $user['password'] = Hash::make($request->password);
            $user->save();


            $user['token'] = $token;
            $user =  new UserResource($user);
            if ($token && $user) {return $this->apiResponse($user);}
            $this->unKnowError();
            return $this->apiResponse(__($user,null,200));
        }else{
            return $this->apiResponse('',__('messages.error_code'),'402');
        }
    }


    public function mobile_activation(Request $request)
    {
        $rules = [
            'code'              =>  'required',
            'phone'             =>  'required',
            'verification_code' =>  'required'
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;

        $phone = $request->phone;


        $checked = (substr($phone,0,1));


        if ($checked == "0"){

            $phone = $request->code . substr($phone,1);

        }else{
            $phone = $request->code . $phone;
        }

        /*$checked996 = substr($request->phone,0,3);

        if ($checked996 == "966"){
            $phone = substr($request->phone,3);
        }

        $checked = (substr($phone,0,1));


        if ($checked == "0"){

            $phone = $request->code . substr($phone,1);

        }else{
            $phone = $request->code . $phone;
        }*/


        $user=User::where('phone',$phone)
            ->where('verification_code', $request['verification_code'])->first();
        if ($user){
            $user->is_verified=1;
            $user->verification_code=0;
            $user->save();
            $token = JWTAuth::fromUser($user);

            $user['token'] = $token;
            $user =  new UserResource($user);
            return $this->apiResponse($user);

//            return $this->apiResponse(__('messages.success_code'));

        }else{
            return $this->apiResponse('',__('messages.error_code'),'402');
        }
    }


    public function check_code(Request $request)
    {
        $rules = [
            'code'              =>'required',
            'phone'             =>'required',
            'verification_code' =>'required',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;

        $phone = $request->phone;

        $checked = (substr($phone,0,1));


        if ($checked == "0"){

            $phone = $request->code . substr($phone,1);

        }else{
            $phone = $request->code . $phone;
        }


        $user=User::where('phone',$phone)
            ->where('verification_code',
                $request['verification_code'])->first();
        if ($user){
            return $this->apiResponse(__('messages.success_code'));
        }
        else{
            return $this->apiResponse('',__('messages.error_code'),'402');
        }
    }

    public function resend_code(Request $request)
    {
        $rules = [
            'phone'=>'required',
            'code'=>'required',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;



        $phone = $request->phone;

        /*$checked996 = substr($request->phone,0,3);

        if ($checked996 == "966"){
            $phone = substr($request->phone,3);
        }

        */
        $checked = (substr($phone,0,1));


        if ($checked == "0"){

            $phone = $request->code . substr($phone,1);

        }else{
            $phone = $request->code . $phone;
        }


        $user=User::where('phone',$phone)->first();


        if ($user){

            $verification_code = mt_rand(1000,9999);
            $user->verification_code = $verification_code;
            $user->save();

            $numbers = $user->phone;						   	//the mobile number or set of mobiles numbers that the SMS message will be sent to them, each number must be in international format, without zeros or symbol (+), and separated from others by the symbol (,).
            $msg = "تهانينا كود التفعيل الخاص بك من باكيج (Package) هو: ".$verification_code;
            $MsgID = rand(1,99999);

            sendSMS($msg, $numbers, $MsgID);


            try{

                $data = array('code'=>$user->verification_code);

                Mail::send('emails.forget_password', $data, function($message) use ($user) {
                    $message->to($user->email, 'كود لاعادة تفعيل كلمة السر')->subject
                    ('كود لاعادة تفعيل كلمة السر');
                    $message->from('info@sheari.net','Package');
                });
            }catch (\Exception $e){

            }



            return \response()->json([
                'status'    => true,
                'message'   => "تم اعاده ارسال الكود بالفعل "
            ],200);


        }

        else{
            return $this->apiResponse('',__('messages.error_code'),'402');
        }
    }
    public function Logout()
    {
        auth()->user()->update([
            'fcm_token_android'=>null,
            'fcm_token_ios'=>null,
            'is_online'=>0,
        ]);

        return $this->apiResponse(__('تم تسجيل الخروج بنجاح بنجاح'));
    }

    /**
     * Update User Profile
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function UpdateProfile(Request $request)
    {
//        $request['role'] = $type;
        //$user = auth()->user();

        $user = JWTAuth::user();

        //dd($user);
        if(!$user){
            return \response()->json([
                'status'    => false,
                'message'   => "من فضلك قم بتسجيل الدخول "
            ],401);
        }

        //dd($user->role);
        if($user->role == 'provider'){

            $rules = [

                'name'  =>'nullable|string|max:191',
                'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
                'code'      =>'required',
                'phone'      =>'nullable|string|max:191|unique:users,phone,'.$user->id,
                'image' =>'nullable|mimes:jpg,jpeg,gif,png',
                'job'   =>'nullable|string|max:191',
                'city_id'   =>'nullable|integer|exists:cities,id',
                'discount'   =>'nullable|string',
                'ads_category'   =>'nullable|integer|exists:ads_categories,id',
                'lng'   =>'nullable|string',
                'lat'   =>'nullable|string',
                'bio'   =>'nullable',
                'address'                   =>'nullable|string',
                'provider_company_type'   =>'nullable|string',
                'company_type'=>'nullable|string',
                'commerical_no'    => 'nullable',
                'account_maroof'    => 'nullable|in:yes,no',
                'account_freelancer'    => 'nullable|in:yes,no'

//          'sub_category_id'       =>'required_if:role,==,provider|integer|exists:regions,id',
            ];
            $validation=$this->apiValidation($request,$rules);

            if($validation instanceof Response){return $validation;}
            if ($request->image != null)
            {
                if ($request->hasFile('image')) {
                    deleteImg($user->image);

                    $image = $request->file('image');
                    $filename = 'image_' . time();
                    $filePath = 'photos/' . $filename . '.webp';

                    // Save the original image to the storage
                    Storage::disk('public')->put($filePath, File::get($image));

                    $user->image  = 'photos/'.$filename . '.webp';

                }
            }

            $user->name = ($request->name)? $request->name : $user->name;

            $user->email = ($request->email)? $request->email : $user->email;
            // check phone
            if(isset($request->phone)){

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


                $user->phone = $phone;
            }
            /*
             *  'commerical_no'    => 'nullable',
            'account_maroof'    => 'nullable|in:yes,no',
            'account_freelancer'    => 'nullable|in:yes,no'
             * */
            $user->city_id = ($request->city_id)? $request->city_id : $user->city_id;

            $user->discount = ($request->discount)? $request->discount : $user->discount;

            $user->ads_category = ($request->ads_category)? $request->ads_category : $user->ads_category;

            $user->lng = ($request->lng)? $request->lng : $user->lng;

            $user->lat = ($request->lat)? $request->lat : $user->lat;

            $user->bio = ($request->bio)? $request->bio : $user->bio;

            $user->job = ($request->job)? $request->job : $user->job;

            $user->commerical_no = ($request->commerical_no)? $request->commerical_no : $user->commerical_no;

            $user->account_freelancer = ($request->account_freelancer)? $request->account_freelancer : $user->account_freelancer;

            $user->account_maroof = ($request->account_maroof)? $request->account_maroof : $user->account_maroof;

            $user->address = ($request->address)? $request->address : $user->address;

            $user->provider_company_type = ($request->provider_company_type)? $request->provider_company_type : $user->provider_company_type;
            $user->provider_type = ($request->provider_type)? $request->provider_type : $user->provider_type;


            if($user->save()){

                $token = JWTAuth::fromUser($user);

                $user['token'] = $token;

                $user =  new UserResource($user);

                return $this->apiResponse($user);
            }else{
                return \response()->json([
                    'status'    => false,
                    'message'   => "تأكد من البيانات"
                ],401);
            }



        }else{
            $rules = [
                'name'  =>'nullable|string|max:191',
                'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
                'phone'      =>'nullable|string|max:191|unique:users,phone,'.$user->id,
                'image' =>'nullable|mimes:jpg,jpeg,gif,png',
                'job'   =>'nullable|string',
                'bio'   =>'nullable|max:191',
                'city_id'   =>'nullable|integer|exists:cities,id',
                'lng'   =>'nullable|string',
                'lat'    =>'nullable|string',
            ];

            $validation=$this->apiValidation($request,$rules);

            if($validation instanceof Response){return $validation;}

            if ($request->image != null)
            {
                if ($request->hasFile('image')) {
                    deleteImg($user->image);
                    $picture = uploadImageWithCompress($request,'image',150,150);
                    $user->image = $picture;
                }
            }

            $user->name = ($request->name)? $request->name : $user->name;
            $user->email = ($request->email)? $request->email : $user->email;
            if(isset($request->phone)){

                $phone =$request->phone;


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



                $user->phone = $phone;
            }

            $user->city_id = ($request->city_id)? $request->city_id : $user->city_id;
            $user->lng = ($request->lng)? $request->lng : $user->lng;
            $user->lat = ($request->lat)? $request->lat : $user->lat;
            $user->job = ($request->job)? $request->job : $user->job;
            $user->bio = ($request->bio)? $request->bio : $user->bio;
            if($user->save()){
                $token = JWTAuth::fromUser($user);
                $user['token'] = $token;
                $user =  new UserResource($user);
                return $this->apiResponse($user);
            }else{
                return \response()->json([
                    'status'    => false,
                    'message'   => "تأكد من البيانات"
                ],401);
            }

        }
    }

    /**
     * Update User Profile
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */

    public function UpdateLocation(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'lat' =>'required|string|max:191',
            'lng'  =>'required|string|max:191',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

      $this->UpdateClientProfile($user,$request);
        if ($user)  return $this->apiResponse(new SingleUserResource($user),null,200);
       return $this->unKnowError();
    }

    /**
     * Update User Setting
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */


    public function UpdateSetting(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'image_download' =>'required|boolean',
            'language'  =>'required|string|max:191',
            'country'  =>'required|string|max:191',
            'notifiable' =>'required|boolean',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
         $this->UpdateClientSetting($user,$request);
        if ($user)  return $this->apiResponse(new UserResource(auth()->user()),null,200);
        return $this->unKnowError();
    }


    public function GetProfile($id){
        $provider=User::find($id);
        $favourite=\App\Models\Favourites::where('user_id',auth()->id())->where('provider_id',$id)->first();
        if($provider){
            if($provider->role=='provider'){
                $orders=$provider->comment() ;
                $provider =  new UserResource($provider);
                $like=false;
                if($favourite){
                    $like=true;
                }
                return $this->createdResponse(['rate'=>$provider->rate(),'like'=>$like,'provider'=>$provider,'comment'=>$orders]);
            }else{
               return $this->unKnowError();
            }
        }else{
            return $this->unKnowError();
        }
    }




    public function getUserprofile()
    {
        // Check if the current request is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Get the stored token from the user's session or database
            $storedToken = $user->user_token; // Assuming you store the token in the session

            // Get the bearer token from the request headers
            $bearerToken = request()->bearerToken();

            // Check if both tokens exist
            if ($storedToken && $bearerToken) {
                // Check if the bearer token matches the stored token
                if ($bearerToken === $storedToken) {

                        $provider =  new UserResource($user);

                        return $this->createdResponse([$provider]);



                } else {
                    // Tokens don't match, return Unauthorized response
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            } else {
                // Tokens are missing, return Unauthorized response
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            // Not authenticated, return Unauthorized response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function UpdateUserStatus(Request $request)
    {
        // Check if the current request is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Get the stored token from the user's session or database
            $storedToken = $user->user_token; // Assuming you store the token in the session

            // Get the bearer token from the request headers
            $bearerToken = request()->bearerToken();

            // Check if both tokens exist
            if ($storedToken && $bearerToken) {
                // Check if the bearer token matches the stored token
                if ($bearerToken === $storedToken) {

//                        $user = User::find($user->id);
                        $user->is_online = $request->status;
                        $user->save();
                        

                    $user =  new UserResource($user);

                    return $this->createdResponse([$user]);



                } else {
                    // Tokens don't match, return Unauthorized response
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            } else {
                // Tokens are missing, return Unauthorized response
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            // Not authenticated, return Unauthorized response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function GetProvider($id){
        $provider=User::find($id);

        $provider =  new UserResource($provider);
        if($provider){
            if($provider->role=='provider'){
                $user_agent = \request()->userAgent();
                $user_ip    = \request()->ip();

                $providerCounter = ProviderViewer::where([
                    'user_agent'    =>$user_agent,
                    'user_ip'            =>$user_ip,
                    'user_id'   => $provider->id,
                ])->first();
                if (auth()->id() != $provider->id){
                    if (!$providerCounter){
                        ProviderViewer::create([
                            'user_id'       => $provider->id,
                            'user_ip'       => $user_ip,
                            'user_agent'    => $user_agent
                        ]);
                    }
                }
                return $this->createdResponse(['provider'=>$provider]);
            }else{
                return $this->unKnowError();
            }
        }else{
            return $this->unKnowError();
        }

    }


    public function DeleteProvider($id){
        $user=User::find($id);
        if($user){
            try{
                //chats
                //favorites
                //notifications
                //orders
                //payments
                //provider_projects
                //provider_viewers
                //user_sub_categories
                if($user->messages()){
                $user->messages()->delete();
                }
                if($user->toMeMessages()){
                $user->toMeMessages()->delete();
                }
                if($user->userSubCategories()){
                $user->userSubCategories()->delete();
                }
                if($user->favourites_user()){
                $user->favourites_user()->delete();
                }
                if($user->userNotifications()){

                $user->userNotifications()->delete();

                }
                if($user->userOrders()){

                $user->userOrders()->delete();

                }
                if($user->providerOrders()){

                $user->providerOrders()->delete();

                }

                if($user->projects()){

                $user->projects()->delete();
                }
                if($user->providerCount()){

                $user->providerCount()->delete();

                }
                $user->delete();
                return $this->apiResponse('ok');

            }catch (\Exception $e) {
               return $this->unKnowError();
            }

        }else{
            return $this->unKnowError();
        }

    }

}
