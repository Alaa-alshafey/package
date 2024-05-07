<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserProviderResource;
use App\Models\Notification;
use App\Models\Order;
use App\Models\ProviderProject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponses;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use Tymon\JWTAuth\JWTAuth;
use Validator;
use Illuminate\Http\Response;
use \Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function GetAllProviderAcceptedOrdered()
    {
        $Accepted = Order::where('provider_id',auth()->id())->where('status','accepted')->has('client')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($Accepted));
    }

    public function GetAllProviderAllOrdered()
    {
        $Accepted = Order::where('provider_id',auth()->id())->has('client')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($Accepted));
    }

    public function OrderProviderUserDetails($order_id)
    {
        $order = Order::find($order_id);
        return $this->apiResponse(new UserProviderResource($order));
    }


    public function GetAllProviderPendingOrdered()
    {
        $pending = Order::where('provider_id',auth()->id())->where('status','pending')->has('client')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($pending));
    }


    public function GetAllProviderCanceledOrdered()
    {
        $canceled = Order::where('provider_id',auth()->id())->where('status','canceled')->has('client')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($canceled));
    }


    public function GetAllProviderFinishedOrdered()
    {
        $canceled = Order::where('provider_id',auth()->id())->where('status','finished')->has('client')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($canceled));
    }

    /**
     * Display a listing of the user ordered.
     *
     *
     */

    public function GetAllUserAcceptedOrdered()
    {
        $Accepted = Order::where('user_id',auth()->id())->where('status','accepted')->has('provider')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($Accepted));
    }

   public function GetAllUserAllOrdered()
    {
        $Accepted = Order::where('user_id',auth()->id())->has('provider')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($Accepted));
    }

    public function GetAllUserPendingOrdered()
    {
        $pending = Order::where('user_id',auth()->id())->where('status','pending')->has('provider')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($pending));
    }

    public function GetAllUserCanceledOrdered()
    {
        $canceled = Order::where('user_id',auth()->id())->where('status','canceled')->has('provider')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($canceled));
    }

    public function GetAllUserFinishedOrdered()
    {
        $canceled = Order::where('user_id',auth()->id())
            ->where(function($q) {
                $q->where('status', 'finished');
            })->has('provider')->latest("updated_at")->paginate(15);
        return $this->apiResponse(new OrderResource($canceled));
    }

    public function Addproject(Request $request){

        $rules = array(
            'title' =>'required|string|max:191',
            'price' =>'nullable|integer',
            'description'   =>'nullable|string',
            'file'   =>'nullable|mimes:jpg,jpeg,png|max:2048',
            'file_type'   =>'nullable|in:image,video,audio',
        );

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
            $inputs=$request->all();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $originalFilename = $image->getClientOriginalName(); // Get original filename
            $extension = $image->getClientOriginalExtension(); // Get original extension
            $filename = 'image_' . time();

            // Save the original image to the storage with its original extension
            $filePath = 'photos/' . $filename . '.' . $extension;
            Storage::disk('public')->put($filePath, File::get($image));

            // Save the file path to your database or use it as needed
            $inputs['image'] = $filePath;
            $inputs['file'] = $filePath;
        }

            $inputs['user_id']=auth()->id();

            $project=ProviderProject::create($inputs);


            if($project->file){
                $project->file=getimg($project->file);
            }else{
                $project->file = null;
            }
        return $this->createdResponse($project);
    }

    public function EditProject(Request $request,$id){
        $project=ProviderProject::find($id);
        dd(auth()->id());
        if(!$project){
            return \response()->json([
                'status'    => false,
                'message'   => ' المشروع غير موجود'
            ],400);
        }
        if($project->user_id!=auth()->id())
            return \response()->json([
                'status'    => false,
                'message'   => ' لا تمتلك هذا المشروع'
            ],400);

        $rules = array(
            'title' =>'required|string|max:191',
            'price' =>'nullable|integer',
            'description'   =>'nullable|string',
            'file'   =>'nullable|mimes:jpg,jpeg,gif,png|max:2048',
            'file_type'   =>'required|in:image,video,audio',
        );
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $inputs=$request->all();
        if($request->hasFile('file')){
            $image = $request->file('file');
            $filename = 'file_'.time();
            $filename = 'image_' . time();
            $filePath = 'photos/' . $filename . '.webp';

            // Save the original image to the storage
            Storage::disk('public')->put($filePath, File::get($image));

            $inputs['image'] = 'photos/'.$filename . '.webp';

            //$image = uploadBanner($request,'file');

            $inputs['file']='photos/'.$filename . '.webp';

        }

        $inputs['user_id']=auth()->id();
        $project->update($inputs);



        if($project->file){
            $project->file=getimg($project->file);
        }else{
            $project->file = null;
        }

        return $this->createdResponse($project);
    }

    public function Getproject($id){

        $project=ProviderProject::find($id);

        if(!$project){
            return \response()->json([
                'status'    => false,
                'message'   => 'please make sure that id is true'
            ],404);
        }
        if($project->user_id != auth()->id())
            return $this->unKnowError();

        $project->file=getimg($project->file);
        return $this->createdResponse($project);
    }

    public function GetProviderprojects(){

        $projects=ProviderProject::where('user_id',auth()->id())->get();

        foreach ($projects as $project){
            if($project->file){
                $project->file=getimg($project->file);
            }else{$project->file = null;}

        }
        return $this->createdResponse($projects);
    }

    public function GetProjectsForProvider($id){


         $projects=ProviderProject::where('user_id',$id)->get();

         foreach ($projects as $project){

             if($project->file){

                 $project->file=getimg($project->file);
             }else{$project->file = "https://sheari.net/22.jpg";}

         }

         return $this->createdResponse($projects);
     }

//
//    public function GetProjectsForProvider($id)
//        {
//            $projects = ProviderProject::where('user_id', $id)->get();
//
//
//            foreach ($projects as $project) {
//
//                if($project->file_webb){
//
//                    $project->file = $project->file_webb;
//
//                }else{
//                    if ($project->file) {
//                        // Check if the file extension is not 'webp'
//                        $extension = pathinfo($project->file, PATHINFO_EXTENSION);
//
//                        if (strtolower($extension) !== 'webp') {
//
//                            // Update the image extension to 'webp' and save it
//                            $project->file = updateImageToWebP($project->file);
//                            $project_data = ProviderProject::find($project->id);
//
//                            $project_data->file_webb = $project->file;
//                            $project_data->save();
//                        } else {
//                            // If the image is already in 'webp' format, no need to update
//                            $project->file = getimg($project->file);
//                        }
//                    } else {
//                        // Set a default image URL if no file is provided
//                        $project->file = "https://package.sa/profile-placeholder.png";
//                    }
//                }
//            }
//
//            return $this->createdResponse($projects);
//        }



    public function DeleteProject($id){

        $project=ProviderProject::findOrFail($id);

        if($project->user_id!=auth()->id())
            return $this->unKnowError();

        $project->delete();
        return $this->createdResponse($project);
    }

    public function SendOrder(Request $request){
        ///$request['time']=$request->date.' '.$request->time;


        $rules = [
            'title' =>'required|string|max:191',
            'details' =>'nullable|string',
            'lng'      =>'nullable|string',
            'lat'      =>'nullable|string',
            'expected_time'      =>'nullable|string',
            'expected_money'      =>'required|string',
//            'date'   =>'required|date|after_or_equal:' . date('Y-m-d'),
//            'time'=>'required|string|after_or_equal:'. date('Y-m-d H:i'),
//            'for'   =>'required|string',
            'provider_id'   =>'required',
            'attachment'   =>'nullable|mimes:jpg,jpeg,gif,png|max:2048',
        ];

        $validation=$this->apiValidation($request,$rules);

        if($validation instanceof Response){return $validation;}

        $provider=User::where('role','provider')->where('id',($request->provider_id))->first();
        $user = auth()->user();

        if($provider)
        {

            $inputs=$request->all();


            // check the user is special or not
            if($user->is_special){
                // is special // check the provider is special
                if($provider->is_special){
                    // check have discount or not
                    if($provider->discount > 0){

                        $discount = $provider->discount;
                        $inputs['discount'] = $discount;
                        // calc new price after discount
                        $total = $request->expected_money;
                        $taxCalc = $total * ($discount / 100);
                        $total_after_discount = $total - $taxCalc;

                        $inputs['price_after_discount'] = $total_after_discount;
                    }else{
                        // not have discount

                        $inputs['discount'] = 0;

                        $inputs['price_after_discount'] = $request->expected_money;

                    }

                }else{

                    // provider not special user can not have offer
                    $inputs['discount'] = 0;
                    $inputs['price_after_discount'] = $request->expected_money;

                }
            }else{

                // user not special
                $inputs['discount'] = 0;
                $inputs['price_after_discount'] = $request->expected_money;

            }

            $inputs['status']='pending';

            //$inputs['service_id']=$user->service_id;

            //$inputs['important']=$request->important;

            $inputs['user_id']=$user->id;

            if($request->hasFile('attachment')){

                //$image = uploader($request,'attachment');

                $image = $request->file('attachment');

            $filename = 'image_' . time();
            $filePath = 'photos/' . $filename . '.webp';

            // Save the original image to the storage
            Storage::disk('public')->put($filePath, File::get($image));

            $inputs['attachment'] = 'photos/' . $filename . '.webp';

            }

            $order=Order::create($inputs);
            $notfication = new \App\Models\Notification();
            $notfication->title="لديك طلب جديد";
            $notfication->type='order';
            $notfication->item_id=$order->id;

            $notfication->notification_status='pending';
            $notfication->user_id=$order->provider_id;
            $notfication->save();
            $result="";
            if($provider->fcm_token_android)
                $result = $this->notifyByFirebase(' لديك طلب جديد',
                    $order->title,
                    [$provider->fcm_token_android],
                    [
                        'type'=>'order',
                        'data'=>$order
                    ],
                    true);
            /*
                       $result = $this->notifyByFirebase(' لديك طلب جديد',
                                $order->title,
                                [$provider->fcm_token_android],
                                [
                                    'type'=>'order',
                                    'data'=>$order
                                ],
                                true);

                       */
            if($provider->fcm_token_ios)
                $result = $this->notifyByFirebase(' لديك طلب جديد',$order->title,[$provider->fcm_token_ios],
                    ['type'=>'order','data'=>$order],true);



            /*
            $result = $this->notifyByFirebase(' لديك طلب جديد',$order->title,[$provider->fcm_token_ios],
                    ['type'=>'order','data'=>$order],true);*/


            if ($provider->device_token){
                sendSingleNotification($provider->device_token,
                    'الطلبات',
                    "لديك طلب جديد $order->title");
            }

            $data['order']=$order;

            $data['order_icon'] = asset('/img/order_status/01-1.png');

            $data['result']=$result;


            $msg = "هلا بك وصلك طلب على حسابك في بكج للفنون والفعاليات (Package) ... فالك التوفيق";

            $numbers = $provider->phone;

            $MsgID = rand(1,99999);

            $result=sendSMS($msg, $numbers, $MsgID);






            try{
                $data = array('order'=>$order);
                Mail::send('emails.order', $data, function($message) use ($provider) {
                    $message->to($provider->email, 'نشعركم بوصول طلب جديد في منصة بكج')->subject
                    ('نشعركم بوصول طلب جديد في منصة بكج');
                    $message->from('info@package.sa','Package');
                });


                Mail::send('emails.order2', $data, function ($message) use ($user) {
                    $message->to($user->email, ' أرسال طلب جديد')->subject
                    (' أرسال طلب جديد');
                    $message->from('info@package.sa', 'Package');
                });
                $data = array('order'=>$order);

                //dd($data['order']->user);

                Mail::send('emails.sheari_order', $data, function($message) {
                    $message->to('alaa.alshafey12345@gmail.com', 'تفاصيل طلب جديد في بكج')->subject
                    ('تفاصيل طلب جديد في بكج');
                    $message->from('info@package.sa','Package');
                });

                Mail::send('emails.sheari_order', $data, function($message) {
                    $message->to('mom3932m@gmail.com', 'تفاصيل طلب جديد في بكج')->subject
                    ('تفاصيل طلب جديد في بكج');
                    $message->from('info@package.sa','Package');
                });

                Mail::send('emails.sheari_order', $data, function($message) {
                    $message->to('ayed200727@yahoo.com', 'تفاصيل طلب جديد في بكج')->subject
                    ('تفاصيل طلب جديد في بكج');
                    $message->from('info@package.sa','Package');
                });

            }catch (\Exception $e){

            }




            return $this->createdResponse($data);
        }else{

            return \response()->json([
                'value' => false,
                'msg' => 'مزود الخدمة غير موجود',
            ],200);
        }
    }


    public function updatePrice(Request $request){


        $rules = [
            //'lng'      =>'required|string',
            //'lat'      =>'required|string',
            'update_price'        =>'required',
            'order_id'            =>'required',
//            'date'   =>'required|date|after_or_equal:' . date('Y-m-d'),
//            'time'=>'required|string|after_or_equal:'. date('Y-m-d H:i'),
//            'for'   =>'required|string',
        ];

        $validation=$this->apiValidation($request,$rules);

        if($validation instanceof Response){return $validation;}


        $order=Order::findOrfail($request->order_id);


        $user = User::findOrfail($order->user_id);
        $provider = User::findOrFail($order->provider_id);


        // check the user is special or not
        if($user->is_special){
            // is special // check the provider is special
            if($provider->is_special){
                // check have discount or not
                if($order->discount > 0){

                    $discount = $order->discount;

                    // calc new price after discount

                    $total = $request->update_price;

                    $taxCalc = $total * ($discount / 100);

                    $total_after_discount = $total - $taxCalc;

                    $order->price_after_discount = $total_after_discount;

                }else{

                    // not have discount

                    $order->price_after_discount = $request->update_price;

                }

            }else{

                // provider not special user can not have offer
                $order->price_after_discount = $request->update_price;

            }
        }
        else{

            // user not special
            $order->price_after_discount = $request->update_price;
        }



        $order->expected_money = $request->update_price;

        $order->save();

        $notfication = new \App\Models\Notification();
        $notfication->title=" تم تحديث السعر الخاص بالطلب";
        $notfication->type='order';
        $notfication->item_id=$order->id;
        $notfication->notification_status='price_updated';

        $notfication->user_id=$order->user_id;
        $notfication->save();
        $notfication = new \App\Models\Notification();
        $notfication->title=" تم تحديث السعر الخاص بالطلب";
        $notfication->type='order';
        $notfication->notification_status='price_updated';
        $notfication->item_id=$order->id;
        $notfication->user_id=$order->provider_id;
        $notfication->save();

        $result = "";

        if($user->fcm_token_android)
            $result = $this->notifyByFirebase(' تم تحديث سعر الطلب ',
                $order->title,
                [$user->fcm_token_android],
                [
                    'type'=>'order',
                    'data'=>$order
                ],
                true);
        if($user->fcm_token_ios)
            $result = $this->notifyByFirebase('تم تحديث سعر الطلب ',
                $order->title,
                [$user->fcm_token_ios],
                ['type'=>'order','data'=>$order],true);


        if ($user->device_token){
            sendNotification($user->device_token,'الطلبات ',"تم تحديث سعر الطلب $order->title");
        }
        $data['order']=$order;

        $data['order_icon'] = asset('/img/order_status/01-1.png');

        $email_data = array('order'=>$order);

        try{
            Mail::send('emails.update_price', $email_data, function($message) use ($user) {
                $message->to($user->email, 'تم تحديث سعر الطلب')->subject
                ('نشعركم بتحديث سعر طلبكم من قبل المزود');
                $message->from('info@package.sa','Package');
            });
        }catch (\Exception $e){

        }



        $data['result']=$result;

        return $this->createdResponse($data);

    }



    public  function cancelOrder(Request $request){

        $rules = [
            'order_id' =>'required',
            'reason'=>'required|string'
        ];
        $validation=$this->apiValidation($request,$rules);

        if($validation instanceof Response){return $validation;}

        $order=Order::find($request->order_id);


        //dd($order);

        if($order){
            if($order->user_id==auth()->id()){

                $user=User::find($order->provider_id);

                $order->status='canceled';
                $order->save();

                $notfication = new \App\Models\Notification();
                $notfication->title=" تم الغاء الطلب من قبل العميل";
                $notfication->type='order';
                $notfication->user_id=$order->user_id;
                $notfication->item_id=$order->id;
                $notfication->notification_status='canceled';
                $notfication->save();
                $result="";
                if ($user->fcm_token_android)
                     $result = $this->notifyByFirebase(' تم الغاء الطلب من قبل العميل',
                         $order->title,[$user->fcm_token_android],['type'=>'order','data'=>$order],false);
                if ($user->fcm_token_ios)
                     $result = $this->notifyByFirebase(' تم الغاء الطلب من قبل العميل',$order->title,[$user->fcm_token_ios],['type'=>'order','data'=>$order],true);


                if ($user->device_token){
                    sendNotification($user->device_token,'الطلبات'," تم الغاء الطلب من قبل العميل $order->title");
                }

                $data['order']=$order;
                $data['result']=$result;

                $email_data = array('order'=>$order);

                try{
                    Mail::send('emails.canceled_order2', $email_data, function($message) use ($user) {
                        $message->to($user->email, 'تم الغاء الطلب من قبل العميل  ')->subject
                        ('تم الغاء الطلب من قبل العميل ');
                        $message->from('info@package.sa','Package');
                    });
                }catch (\Exception $e){

                }



                return $this->createdResponse($data);
            }
            elseif($order->provider_id==auth()->id()){

                $user=User::find($order->user_id);
                $order->status='canceled';
                $order->save();
                $notfication = new \App\Models\Notification();
                $notfication->title=" تم الغاء الطلب من قبل مزود الخدمة";
                $notfication->type='order';
                $notfication->user_id=$order->user_id;
                $notfication->item_id=$order->id;
                $notfication->notification_status='canceled';
                $notfication->save();
                $result="";
                if ($user->fcm_token_android)
                $result = $this->notifyByFirebase(' تم الغاء الطلب من قبل مزود الخدمة',$order->title,[$user->fcm_token_android],['type'=>'order','data'=>$order],false);
                if ($user->fcm_token_ios)
                $result = $this->notifyByFirebase(' تم الغاء الطلب من قبل مزود الخدمة',$order->title,[$user->fcm_token_ios],['type'=>'order','data'=>$order],true);


                if ($user->device_token){
                    sendNotification($user->device_token,'الطلبات'," تم الغاء الطلب من قبل مزود الخدمة $order->title");
                }
                $data['order']=$order;
                $data['result']=$result;

                $email_data = array('order'=>$order);

                try{
                    Mail::send('emails.canceled_order', $email_data, function($message) use ($user) {
                        $message->to($user->email, 'تم الغاء الطلب من قبل الموزد الحدمة ')->subject
                        ('تم الغاء الطلب من قبل الموزد الحدمة ');
                        $message->from('info@package.sa','Package');
                    });
                }catch (\Exception $e){

                }



                return $this->createdResponse($data);
            }
            else{
                return $this->apiResponse(__(' غير مصرح  '));
            }
        }else{
            return $this->apiResponse(__('الطلب غير موجود '));

        }


    }

    public  function finishOrder(Request $request){
        $rules = [
            'order_id' =>'required',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $order=Order::find($request->order_id);

        if($order){

            if($order->provider_id==auth()->id()){
//                if(Carbon::createFromFormat('Y-m-d H:i:s',
//                        $order->date.''.$order->time) >=   Carbon::now())
//                    {
                        $user=User::find($order->user_id);
                        $order->status='finished';
                        $order->save();
                        $notfication = new \App\Models\Notification();
                        $notfication->title=" تم انهاء الطلب من قبل مزود الخدمة";
                        $notfication->type='order';
                        $notfication->user_id=$order->user_id;

                        $notfication->item_id=$order->id;
                        $notfication->notification_status='finished';
                        $notfication->save();
                        $result="";
                        if ($user->fcm_token_android)
                        $result = $this->notifyByFirebase(' تم انهاء الطلب من قبل مزود الخدمة',$order->title,[$user->fcm_token_android],['type'=>'order','data'=>$order],false);
                        if ($user->fcm_token_ios)
                        $result = $this->notifyByFirebase(' تم انهاء الطلب من قبل مزود الخدمة',$order->title,[$user->fcm_token_ios],['type'=>'order','data'=>$order],false);


                        if ($user->device_token){
                            sendNotification($user->device_token,'الطلبات',"  تم انهاء الطلب من قبل مزود الخدمة $order->title");
                        }
                        $data['order']=$order;
                        $data['result']=$result;

                        $email_data = array('order'=>$order);
                        try{
                            Mail::send('emails.finished_order', $email_data, function($message) use ($user) {
                                $message->to($user->email, 'تم انهاء الطلب من قبل الموزد الحدمة ')->subject
                                ('تم انهاء الطلب من قبل الموزد الحدمة ');
                                $message->from('info@package.sa','Package');
                            });
                        }catch (\Exception $e){

                        }




                        return $this->createdResponse($data);
//                }
//                else{
//                    return $this->apiResponse(null,__('الوقت لم ينتهى بعد '),401);
//                }
            }
            else{
                return $this->apiResponse(__(' غير مصرح  '));
            }
        }else{
            return $this->apiResponse(__('الطلب غير موجود '));
        }


    }

    public function rateOrder(Request $request){

        $rules = [
            'order_id' =>'required|string|max:191',
//            'comment'=>'required|string',
            'rate_no'=>'required|numeric|max:5'
        ];

        $validation=$this->apiValidation($request,$rules);

        if($validation instanceof Response){return $validation;}

        $order=Order::find($request->order_id);

        if($order){
            if($order->user_id==auth()->id()){
                $order->comment=$request->comment;
                $order->rate=$request->rate_no;
                $order->save();
                $msg=" لقد تم تقيمك ب  " .$order['rate'];
                $user=User::find($order->provider_id);
                if ($user->fcm_token_android)
                    $result = $this->notifyByFirebase($msg,$order->title,[$user->fcm_token_android],['type'=>'comment','data'=>$order],false);
                if ($user->fcm_token_ios)
                     $result = $this->notifyByFirebase($msg,$order->title,[$user->fcm_token_ios],['type'=>'comment','data'=>$order],true);


                if ($user->device_token){
                    sendNotification($user->device_token,'التقييمات',"$request->comment");
                }

                return $this->createdResponse($order);

            }
            else{
                return $this->apiResponse(__(' غير مصرح  '));
            }
        }else{
            return $this->apiResponse(__('الطلب غير موجود '));
        }


    }

    public function getrates(Request $request){

        $rules = [
            'provider_id' =>'required|string|max:191',
        ];
        $validation=$this->apiValidation($request,$rules);

        if($validation instanceof Response){return $validation;}

        $provider=User::where('role','provider')->where('id',($request->provider_id))->first();

        if(empty($provider)){

            return $this->apiResponse(__('حدثت مشكلة'));

        }else{
            $orders = Order::select('id', 'comment', 'user_id', 'rate')
                ->where('provider_id', $provider->id)
                ->where('rate','!=',null)
                ->get();

            $orders->transform(function ($order) {
                // Retrieve user information for each order
                $user = User::find($order->user_id); // Assuming there's a relationship named 'user' in your Order model
             if($user){
                 $user->image = getimg($user->image);
                 // Append user information to the order
                 $order->user = $user;

             }

                return $order;
            });

            return $this->createdResponse($orders);


        }


    }
    public  function AcceptOrder(Request $request){
        $rules = [
            'order_id' =>'required',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $order=Order::find($request->order_id);
        if($order) {
            if ($order->provider_id == auth()->id()) {
                $user = User::find($order->user_id);
                $order->status = 'accepted';
                $order->save();
                $notfication = new \App\Models\Notification();
                $notfication->title = "تم قبول الطلب  ";
                $notfication->type = 'order';
                $notfication->user_id = $order->user_id;
                $notfication->item_id = $order->id;
                $notfication->notification_status='accepted';
                $notfication->save();
                $result = '';


                if ($user->fcm_token_android)
                    $result = $this->notifyByFirebase(' تم قبول الطلب',
                        $order->title, [$user->fcm_token_android],
                        ['type' => 'order', 'data' => $order],
                        false);


                if ($user->fcm_token_ios)
                    $result = $this->notifyByFirebase(' تم قبول الطلب', $order->title, [$user->fcm_token_ios], ['type' => 'order', 'data' => $order], true);


                // dd(User::find($order->user_id));

                if ($user->device_token){

                    sendNotification($user->device_token,'الطلبات',"تم قبول الطلب $order->title");
                }

                $data['order'] = $order;
                $data['result'] = $result;
                $data['fcm_token_android'] = $user->fcm_token_android;

                $email_data = array('order'=>$order);

                try{
                    Mail::send('emails.accepted_order', $email_data, function($message) use ($user) {
                        $message->to($user->email, 'تمت الموافقة علي طلبكم من قبل الموزد الحدمة ')->subject
                        ('تمت الموافقة علي طلبكم من قبل الموزد الحدمة ');
                        $message->from('info@package.sa','Package');
                    });
                }catch (\Exception $e){

                }


                return $this->apiResponse($data);
            } else {
                return $this->apiResponse(__('غي مصرح'));
            }
        }
        else{
            return $this->apiResponse(__('الطلب غير موجود '));

        }

     }

    public function  getNotification(){
        $notfication =  \App\Models\Notification::where('read','no')->where('user_id',auth()->id())->paginate();

        return $this->apiResponse(new NotificationResource($notfication));
    }

    public function  getNotificationCount(){
        $notfications =  Notification::where('read','no')->where('user_id',auth()->id())->count();
        return $this->apiResponse($notfications);
    }

    public function  showNotification($id){
        $notfication =  \App\Models\Notification::find($id);
        if($notfication){
            $notfication->read='yes';
            $notfication->save();
            return $this->apiResponse(__('تم قراءته '));
        }else{
            return $this->apiResponse(__('الاشعار غير موجود '));
        }
    }

    public function notification($token, $title)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=$token;

        $notification = [
            'title' => $title,
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification,"moredata" =>'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh '];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AIzaSyC_T6iu_4_TsGwGjCYtUuEs3252JW7W4-Q',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function notifyByFirebase($title,
                                     $body,
                                     $tokens,
                                     $data = [] ,
                                     $is_notification = true)
    {
        // https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
        // API access key from Google FCM App Console
        // env('FCM_API_ACCESS_KEY'));

        //    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
        //    $registrationIDs = array(
        //        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
        //        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
        //        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
        //    );
        $registrationIDs = $tokens;

        // prep the bundle
        // to see all the options for FCM to/notification payload:
        // https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support

        // 'vibrate' available in GCM, but not in FCM
        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );
        // I haven't figured 'color' out yet.
        // On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
        // On another phone, it was the color of the app icon. (ie: LG K20 Plush)

        // 'to' => $singleID ;      // expecting a single ID
        // 'registration_ids' => $registrationIDs ;     // expects an array of ids
        // 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
            'data' => $data
        );
        if ($is_notification)
        {
            $fcmFields['notification'] = $fcmMsg;
        }

        //  'Authorization: key=AAAAq3alF2Q:APA91bFuBZPAKUKT0QjG_KQQXBUGYGb3KKwtdB2YCyTEUF_MC7oehaoalBzAGRpJ6EauhcoBHi02FEy0_fPfJTibh2nPj0GWYnE8QRy-3oRDE105DGC8pp_pFkXtyaP2weJwmcKTJYQd',
        $headers = array(
            'Authorization: key=AAAAq2dTeSA:APA91bG0qImTuLrEI5KBaJII5tNnxCBb1Y92irWAjX18CD1ia0_G0vxhW3DFeCBmdnb2tRw8FCrNEa88Vur-9Q3sZAQd195XmdEkWp-VbqN9gya63orKq_n8mF90nm6cY30LazISg-YA',
            'Content-Type: application/json'
        );

        /*        info("API_ACCESS_KEY_client: ".env('API_ACCESS_KEY_client'));
               info("PUSHER_APP_ID: ".env('PUSHER_APP_ID'));*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function orderStatus($order_id){
        $order=Order::find($order_id);
        if($order) {
            $isRated=false;
            $isFinished=false;
            $isComment=false;
            if($order->rate!=null){
                $isRated=true;
            } if($order->comment!=null){
                $isComment=true;
            }if($order->status=='finished'||$order->status=='canceled'){
                $isFinished=true;
            }
            $data=['isRated'=>$isRated,'isComment'=>$isComment,'isFinished'=>$isFinished];

            return $this->apiResponse($data);

        }
        return $this->apiResponse(null,__(' غير موجود '));


    }
}
