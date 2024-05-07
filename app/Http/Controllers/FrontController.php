<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdsCategory;
use App\Models\Advertisement;
use App\Models\Cat_Event;
use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Event;
use App\Http\Traits\FCMOperation;
use App\Models\Inbox;
use App\Models\Message;
use App\Models\Models\Cleaner;
use App\Models\Notification;
use App\Models\Order;
use App\Models\ProviderProject;
use App\Models\ProviderViewer;
use App\Models\Report;
use App\Models\Service;
use App\Models\SubCat_Event;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Contact_Us;
use App\Models\UserSubCategory;
use Carbon\Carbon;
use Doctrine\DBAL\Events;
use function GuzzleHttp\Psr7\str;
use Hash;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use \Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Project;
use PHPMailer\PHPMailer\PHPMailer;

class FrontController extends Controller
{


    public function task(){
        $arr = [17,19,21];

        $sum = 0;
        $num = 0;
        foreach ($arr as $item){
            $num = 0;
            if (($item % 2) == 1){
                // this is ood
                if ($item == 5){
                    $num = 5;
                }else{
                    $num = 3 ;
                }

            }elseif ($item % 2 == 0){

                if ($item == 5){
                    $num = 5;
                }else{
                    // this is even
                    $num = 1;
                }

            }elseif($item == 5){
                $num=5;
            }

            $sum+=$num;
        }

        dd($sum);
    }

    use FCMOperation;


    public function checkEmail(Request $request)
    {
        //return true;
        $email = $request->email;
        $emailcheck = User::where('email',$email)->count();
        if($emailcheck > 0)
        {
           return response()->json(array('msg'=>true),200);
        }else{

            return response()->json(array('msg'=>false),200);
        }
    }


    public function active(){
        return view('user.active');
    }
    public function mobile_activation(Request $request)
    {
        $this->validate($request,[
            'verification_code' => 'required|integer',
        ]);

        $verification_code =  ($request['verification_code']);
        $verification_code = (int) $verification_code;
        //dd($verification_code);
        $user=User::where('verification_code', $verification_code)->first();
        //dd($user);
        if ($user){
            $user->is_verified=1;
            $user->verification_code=0;
            $user->save();
            $user = \Auth::user();
            if ($user){
                alert()->success('تم تفعيل الحساب !')->autoclose(50000);
                return redirect()->home();
            }

            alert()->success('تم تفعيل الحساب قم بتسجيل الدخول !')->autoclose(50000);
            return redirect()->route('login');
//            return $this->apiResponse(__('messages.success_code'));

        }else{
            alert()->error('الكود غير صحيح!')->autoclose(50000);
            return redirect()->back();
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	 //return it is under constriction
        //return view('under_constriction');
        $categories=Category::orderBy('view_number','asc')->get();


        return view('site.home',['categories'=>$categories]);
    }

    public function userIndex()
    {
        $pendingProvider = Order::where('provider_id',auth()->id())
            ->where('status','=','pending')->latest("updated_at")->get();

        $pendingUser = Order::where('user_id',auth()->id())->where('status','=','pending')->latest("updated_at")->get();


        $finishingProvider = Order::where('provider_id',auth()->id())->where('status','=','finished')->latest("updated_at")->get();
        $finishingUser = Order::where('user_id',auth()->id())->where('status','=','finished')->latest("updated_at")->get();

        $canceledProvider = Order::where('provider_id',auth()->id())->where('status','=','canceled')->latest("updated_at")->get();
        $canceledUser = Order::where('user_id',auth()->id())->where('status','=','canceled')->latest("updated_at")->get();

        $acceptedProvider = Order::where('provider_id',auth()->id())->where('status','=','accepted')->latest("updated_at")->get();
        $acceptedUser = Order::where('user_id',auth()->id())->where('status','=','accepted')->latest("updated_at")->get();



        return view('user.home',
            compact('pendingProvider','pendingUser','canceledProvider','canceledUser',
                'finishingUser','finishingProvider','acceptedProvider','acceptedUser')
            );

    }

    public function orders()
    {

        // enhance orders
        /*
         * get pending orders (provider - user)
         * get finishing orders (provider - user)
         * get new orders (provider - user)
         * get canceled orders (provider - user)
         * */
        $pendingProvider = Order::where('provider_id',auth()->id())
            ->where('status','=','pending')->latest("updated_at")->get();

        $pendingUser = Order::where('user_id',auth()->id())->where('status','=','pending')->latest("updated_at")->get();


        $finishingProvider = Order::where('provider_id',auth()->id())->where('status','=','finished')->latest("updated_at")->get();
        $finishingUser = Order::where('user_id',auth()->id())->where('status','=','finished')->latest("updated_at")->get();

        $acceptedProvider = Order::where('provider_id',auth()->id())->where('status','=','accepted')->latest("updated_at")->get();
        $acceptedUser = Order::where('user_id',auth()->id())->where('status','=','accepted')->latest("updated_at")->get();

        $canceledProvider = Order::where('provider_id',auth()->id())->where('status','=','canceled')->latest("updated_at")->get();
        $canceledUser = Order::where('user_id',auth()->id())->where('status','=','canceled')->latest("updated_at")->get();

        return view('user.orders',compact('pendingProvider',
            'pendingUser','finishingProvider','finishingUser','acceptedProvider',
            'canceledProvider','acceptedUser',
            'canceledUser'));
    }



    public function notifications()
    {
        $notifications=\App\Models\Notification::where('read','yes')
            ->where('user_id',auth()->id())->latest()->get();

        foreach ($notifications as $notification){
            $notification->read='yes';
            $notification->save();
        }
        return view('user.notifications');

    }

    public function delete_notifications(){

        $user = auth()->user();

        sendNotification(auth()->user()->device_token,'مسح تنبية','تم مسح التنبية بنجاح');

        $notifications=Notification::where('read','no')
            ->where('user_id',auth()->id())->get();
        foreach ($notifications as $notification){
            $notification->read='yes';
            $notification->save();
        }

//        dd(auth()->user()->device_token);
        sendNotification(auth()->user()->device_token,'مسح تنبية','تم مسح التنبية بنجاح');
        return redirect()->back();
    }

    public function deleteSingleNotification($id){
        $user = auth()->user();
        $notification=Notification::where('id',$id)
            ->where('user_id',auth()->id())->first();

        $notification->read = 'yes';
        $notification->save();


        alert()->info('تم مسح التنبيه ')->autoclose(5000);
        return redirect()->back();

    }

    public function inviteFriends()
    {
        return view('user.invite-friends');

    }

    public function categories()
    {
        $categories=Category::all();
        return view('site.categories',['categories'=>$categories]);
    }

    public function subCategory($id)
    {
        $categories=SubCategory::where('category_id',$id)->get();
        return view('site.subCategory',['categories'=>$categories]);
    }

    public function adsCategory()
    {
        $categories  = AdsCategory::all();
        return view('site.AdsCategory',compact('categories'));
    }

    public function showads($id)
    {
        $ad=Advertisement::findOrFail($id);
        return view('site.singile-ad',['ad'=>$ad]);
    }


    public function contact()
    {

        return view('site.contact-us');
    }

    public function terms()
    {
        return view('site.terms');
    }

    public function privacy_policy()
    {
        return view('site.terms');
//        return view('site.privacy');

    }


    public function map()
    {
        return view('site.search-map');
    }


    public function inboxMessage($id){

        $order = Order::find($id);
        if(auth()->user()->id == $order->user_id){
            $receiver_id = $order->provider_id;
            $receiver   = User::find($order->provider_id);
        }else{
            $receiver_id = $order->user_id;
            $receiver   = User::find($order->user_id);
        }
        $inbox = Inbox::where('order_id',$id)->get();

        return view('user.chat',compact('inbox','receiver_id','receiver'));
    }

    public function SendMessage(Request $request){

        if($request->message != null){
            $inbox = Inbox::create([
                'order_id'      => $request->order_id,
                'user_id'       => $request->user_id,
                'sender_id'     => $request->sender_id,
                'message'       => $request->message,
                'created_at'    => Carbon::now(),
            ]);

            if($inbox){
                $user = User::find($request->user_id);

                if ($user->device_token){
                    $order = Order::find($request->order_id);
                    sendNotification($user->device_token,'الرسائل',"تم استلام رسالة علي الطلب $order->title");
                }

                return back();
            }else{
                alert()->warning('تأكد من البيانات المرسله');
                return back();

            }
        }else{

            alert()->error('من فضلك اكتب الرسالة');
            return back();
        }

    }
    public function service($id)
    {
        $category = SubCategory::findOrFail($id);

        $providers = ($category->PUsers()->orderBy('is_top','DESC')->paginate(25));

        return view('site.single_service',['providers'=>$providers]);

    }
    public function adProvider($id)
    {
        $providers =User::where('ads_category',$id)->orderBy('is_top','DESC')->paginate();
        return view('site.single_service',['providers'=>$providers]);

    }

    public function singleService($id){

        $providers=User::where('role','provider')->where('is_verified',1)->where('service_id',$id)->get();
        return view('site.single_service',['providers'=>$providers]);

    }


    public function requests(){
        $orders = Order::all();
        return view('site.requests')->with('orders',$orders);
    }

    public function offers(){
        return view('site.offers');
    }

    public function profile($id,Request $request){
        $provider=User::where('role','provider')->where('id',$id)->first();

        if(!$provider){
            abort(404);
        }

        // check counter
        $user_agent = $request->userAgent();
        $user_ip    = $request->ip();

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


        return view('site.profile',['provider'=>$provider]);
    }

    public function users()
    {
        return User::all();
    }


    public function privateMessages(User $user)
    {
        $privateCommunication= Inbox::with('user')
            ->where(['user_id'=> auth()->id(), 'sender_id'=> $user->id])
            ->orWhere(function($query) use($user){
                $query->where(['user_id' => $user->id, 'sender_id' => auth()->id()]);
            })
            ->get();

        return $privateCommunication;
    }


    public function sendPrivateMessage(Request $request,User $user)
    {
        if(request()->has('file')){
            $filename = uploader($request, 'file');
            $message=new Inbox();
            $message->sender_id=request()->user()->id;
            $message->image=$filename;
            $message->image_name= str_limit(str_replace('photos','',$filename),50);
            $message->user_id= $user->id;
            $message->save();

//            ([
//                'sender_id' => request()->user()->id,
//                'image' => uploader($request, 'file'),
//                'image_name'=>str_limit(str_replace('photos','',$filename),50),
//                'user_id' => $user->id
//            ]);
        }else{

            $input=$request->all();
            $input['user_id']=$user->id;
            $input['sender_id']=request()->user()->id;

            $message=Inbox::create([
                'sender_id' => request()->user()->id,
                'message'=>$request->message,
                'user_id' => $user->id
            ]);
//            $message=auth()->user()->messages()->create($input);
        }

        $test=broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status'=>'Message private sent successfully','message'=>$message,'$test'=>$test]);

    }


    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

    public function chat() {
        return view('user.msg-list');
    }

    public function singlechat($id) {
        return view('user.msg-list-single',['id'=>$id]);
    }

    public function TESTSMS(Request $request){


        $mobile = "966506601144";							//Mobile number (username) of your alfa-cell.com account
        $msg = "  أهلا بك ف باكيج كود التفعيل";
        $bearer = 'f5d7808a0e272bfd93f6154451c32637';
        $taqnyt = new \TaqnyatSms($bearer);
        $body = $msg;
        $recipients = [$mobile];
        $sender = 'Sheari';
        $smsId = rand(1,99999);
        $result =$taqnyt->sendMsg($body, $recipients, $sender, $smsId);
        return $result;

    }

    public function getCleaners(Request $request)
    {
//        $cleaners = User::get();

        $query = User::query();
        $query->where('role','provider')->where('is_verified',1);
        $query->when(isset($request['category_id']),function ($q) use ($request) {
            if($request['category_id']!=''){
                $users=SubCategory::findOrFail($request['category_id'])->UsersIds();
                return $q->whereIn('id',  $users);
            }
        });
        $query->when(isset($request['city_id']),function ($q) use ($request) {
            if($request['city_id']!='')
            {
                $users = City::findOrFail($request['city_id'])->usersId();

                return $q->whereIn('id',  $users);

            }
        });
        $query->when(isset($request['country_id']),function ($q) use ($request) {
            if($request['country_id']!='')
            {
                if(isset($request['city_id'])){
                    return $q;
                }
                else{
                    $cities=Country::findOrFail($request['country_id'])->cities;
                    $users=[];
                    foreach ($cities as $city){
                        if($city->usersId()){
                            foreach ($city->usersId() as $item){
                                array_push($users,$item);
                            }


                        }
                    }


                    $users=array_unique($users);
                    return $q->whereIn('id',  $users);

                }}
        });
        $array = [];
        $query=$query->take(50)->get();
        foreach ($query as $cleaner) {

            if (isset($cleaner->name) && isset($cleaner->lat) && isset($cleaner->lng) )
            {
                $i = 1;
                array_push($array, [
                    $cleaner->name, (double)$cleaner->lat, (double)$cleaner->lng, 'red',38, -3,route('profile',$cleaner->id)
                ]);
                $i++;
            }
        }

        return $array;
    }

    public function showOrder($id) {
        $order=Order::findOrfail($id);
        return view('user.order',['order'=>$order]);
    }

    public function acceptOrder($id) {

        $order=Order::findOrfail($id);
        $order->status='accepted';
        $order->save();

        $notfication = new \App\Models\Notification();
        $notfication->title="  تم الموافقة على الطلب من قبل الموزود";
        $notfication->type='order';
        $notfication->item_id=$order->id;
        $notfication->notification_status='accepted';
        $notfication->user_id=$order->user_id;
        $notfication->save();

        $user = User::find($order->user_id);

        $email_data = array('order'=>$order);

        Mail::send('emails.accepted_order', $email_data, function($message) use ($user) {
            $message->to($user->email, 'تمت الموافقة علي طلبكم من قبل الموزد الحدمة ')->subject
            ('تمت الموافقة علي طلبكم من قبل الموزد الحدمة ');
            $message->from('info@sheari.net','Package');
        });

        if ($user->device_token){
            sendNotification($user->device_token,'الرسائل',"تم الموافقة على الطلب من قبل الموزود $order->title");
        }

        alert()->success('تمت الموافقة على الطلب ')->autoclose(6000);
        return  back();
    }



    public function updateOrderPrice(Request $request) {

        $this->validate($request,[

            'order_id' =>'required|exists:orders,id',
            'update_price' =>'required|integer|min:0',
//            'date'   =>'required|date|after_or_equal:' . date('Y-m-d'),
//            'time'=>'required|string',
        ]);



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
        }else{

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
        $notfication->item_id=$order->id;

        $notfication->notification_status='price_updated';

        $notfication->user_id=$order->provider_id;
        $notfication->save();

        $user = User::find($order->user_id);


        if ($user->device_token){
            sendNotification($user->device_token,'الرسائل',"تم تحديث السعر الخاص بالطلب $order->title");
        }

        alert()->success('تم تحديث سعر العقد نرجوا مراسلة العميل للاتفاق على السعر النهائي. ')->autoclose(6000);


        $email_data = array('order'=>$order);

        Mail::send('emails.update_price', $email_data, function($message) use ($user) {
            $message->to($user->email, 'تم تحديث سعر الطلب')->subject
            ('نشعركم بتحديث سعر طلبكم من قبل المزود');
            $message->from('info@sheari.net','Package');
        });


        return  back();
    }

    public function cancelOrder($id) {


        $order=Order::findOrfail($id);

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

            Mail::send('emails.canceled_order2', $email_data, function($message) use ($user) {
                $message->to($user->email, 'تم الغاء الطلب من قبل العميل  ')->subject
                ('تم الغاء الطلب من قبل العميل ');
                $message->from('info@sheari.net','Package');
            });

            alert()->info('تم الغاء الطلب');
            return back();

        }elseif ($order->provider_id == auth()->id()){

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

            Mail::send('emails.canceled_order', $email_data, function($message) use ($user) {
                $message->to($user->email, 'تم الغاء الطلب من قبل الموزد الحدمة ')->subject
                ('تم الغاء الطلب من قبل الموزد الحدمة ');
                $message->from('info@sheari.net','Package');
            });

            alert()->info('تم الغاء الطلب');

            return back();
        }else{
           alert()->success('من فضلك قم بتسجيل الدخول');
           auth()->logout();
           return redirect()->back();
        }

    }

    public function finishOrder($id) {

        $order=Order::findOrfail($id);

        $user = User::find($order->user_id);
        $provider = User::find($order->provider_id);

        // provider is special
        if($provider->is_special){
            // النسبة المحققه للموقع هي 2%
            $total_price = $order->expected_money;
            $tax_price   = $total_price * (0.02);
            $provider->commission += $tax_price;
            $provider->save();

        }else{
            // النسبة المحققه للموقع هي 5%
            $total_price = $order->expected_money;
            $tax_price   = $total_price * (0.05);
            $provider->commission += $tax_price;
            $provider->save();
        }



        $notfication = new \App\Models\Notification();
        $notfication->title="تم إنهاء الطلب";
        $notfication->type='order';
        $notfication->item_id=$order->id;
        $notfication->notification_status='finished';
        $notfication->user_id=$order->user_id;
        $notfication->save();

        $notfication = new \App\Models\Notification();
        $notfication->title="تم إنهاء الطلب";
        $notfication->type='order';
        $notfication->item_id=$order->id;
        $notfication->notification_status='finished';
        $notfication->user_id=$order->provider_id;
        $notfication->save();


        $result="";
        if($order->user->fcm_token_android)
            $result = $this->notifyByFirebase(' تم انهاء طلبك ',
                $order->title,
                [$order->user->fcm_token_android],
                ['type'=>'order','data'=>$order],
                false);
        if($order->user->fcm_token_ios)
            $result = $this->notifyByFirebase(' تم انهاء طلبك ', $order->title,[$order->user->fcm_token_ios],['type'=>'order','data'=>$order],true);



        $user = User::find($order->user_id);

        if ($user->device_token){
            sendNotification($user->device_token,'الطلبات',"تم انهاء الطلب$order->title");
        }


        if($order->provider->is_special){
            alert()->success('نذكركم بدفع عمولة موقع باكيج (  2% )  من قيمة العقد ! وذلك بزيارة صفحة الدفع ')->autoclose(6000);

        }else{
            alert()->success('نذكركم بدفع عمولة موقع باكيج (  5% )  من قيمة العقد ! وذلك بزيارة صفحة الدفع ')->autoclose(6000);

        }

        $order->status='finished';
        $order->save();

        $email_data = array('order'=>$order);
        Mail::send('emails.finished_order', $email_data, function($message) use ($user) {
            $message->to($user->email, 'تم انهاء الطلب من قبل الموزد الحدمة ')->subject
            ('تم انهاء الطلب من قبل الموزد الحدمة ');
            $message->from('info@sheari.net','Package');
        });

        return redirect()->back();

    }


    public function sendReport(){
        return view('user.send-report');
    }

    public function saveSendReport(Request $request){

        $this->validate($request,[
            'image'     => 'required|mimes:jpg,jpeg,gif,png',
            'type'      => 'required',
            'message'   => 'nullable'
        ],[
            'image.required'    => 'الصورة مطلوبة اجباري',
            'type.required'    => 'نوع التحويل مطلوب اجباري'
        ]);
        $inputs = $request->all();
        $inputs['user_id']  = auth()->user()->id;
        $inputs['image']    = uploader($request,'image');
        $report = Report::create($inputs);
        if($report){

            alert()->success('تم إستلام إيصال الدفع طلبكم تحت المراجعة')->autoclose(6000);
            return redirect()->back();

        }
        else{
            alert()->info('من فضلك تأكد من البيانات')->autoclose(6000);
            return redirect()->back();
        }


    }



    public function payType(){
        return view('user.pay-type');
    }

    public function payStar(){
        return view('user.pay-star');
    }

    public function payDesign(){
        return view('user.pay-design');
    }
    public function payCommision(){
        return view('user.pay-commission');
    }






    public function sendOrder($id) {
        return view('user.post-requirement',['id'=>$id]);
    }

    public function createAds() {
        return view('user.add-ads');
    }

    public function createOffer() {
        return view('user.add-offer');
    }


    public function postOrder(Request $request,$id) {
        $this->validate($request,[

            'lat' =>'nullable|string|max:191',
            'lng' =>'nullable|string|max:191',
            'title' =>'required|string|max:191',
            'details' =>'nullable|string',
//            'date'   =>'required|date|after_or_equal:' . date('Y-m-d'),
//            'time'=>'required|string',
        ]);

        $inputs=$request->all();
        $provider=User::where('role','provider')->where('id',($id))->first();
        $user = auth()->user();
        if($provider) {

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

            $inputs['provider_id'] = $provider->id;
            $inputs['user_id'] = auth()->id();
            $inputs['status'] = 'pending';
            if($request->hasFile('attachment')){
                $image = uploader($request,'attachment');
                $inputs['attachment']=$image;
            }


            if ($request->get('check_') == "yes"){

                $order=Order::create($inputs);
            }
            else
            {
                $order=Order::create(Arr::except($inputs,['lat','lng']));

            }
            $notfication = new \App\Models\Notification();
            $notfication->title="طلب جديد";
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
                    ['type'=>'order','data'=>$order],
                    false);
            if($provider->fcm_token_ios)
                $result = $this->notifyByFirebase(' لديك طلب جديد',
                    $order->title,[$provider->fcm_token_ios],['type'=>'order','data'=>$order],true);


            $user = User::find($order->user_id);

            if ($user->device_token){
                sendNotification($user->device_token,'الطلبات',"تم إرسال الطلب$order->title");
            }

            alert()->success('تم إرسال الطلب بنجاح !')->autoclose(5000);
            //sending sms

            $data = array('order' => $order);



            $msg = "هلا بك وصلك طلب على حسابك في باكيج (Package) ... فالك التوفيق";

            $numbers = $provider->phone;

            $MsgID = rand(1,99999);

            $result=sendSMS($msg, $numbers,$MsgID);

            // message

            try {


                $data = array('order' => $order);


                Mail::send('emails.order', $data, function ($message) use ($provider) {
                    $message->to($provider->email, 'نشعركم بوصول طلب جديد في منصة باكيج')->subject
                    ('نشعركم بوصول طلب جديد في منصة باكيج');
                    $message->from('info@sheari.net', 'Package');
                });

                Mail::send('emails.order2', $data, function ($message) use ($user) {
                    $message->to($user->email, ' أرسال طلب جديد')->subject
                    (' أرسال طلب جديد');
                    $message->from('info@sheari.net', 'Package');
                });


                // send a mail to  sheari email


                $data = array('order' => $order);

                //dd($data['order']->user);

                Mail::send('emails.sheari_order', $data, function($message) {
                    $message->to('sheari@hotmail.com', 'تفاصيل طلب جديد في باكيج')->subject
                    ('تفاصيل طلب جديد في باكيج');
                    $message->from('info@sheari.net','Package');
                });

                Mail::send('emails.sheari_order', $data, function($message) {
                    $message->to('mom3932m@gmail.com', 'تفاصيل طلب جديد في باكيج')->subject
                    ('تفاصيل طلب جديد في باكيج');
                    $message->from('info@sheari.net','Package');
                });

                Mail::send('emails.sheari_order', $data, function($message) {
                    $message->to('ayed200727@yahoo.com', 'تفاصيل طلب جديد في باكيج')->subject
                    ('تفاصيل طلب جديد في باكيج');
                    $message->from('info@sheari.net','Package');
                });

            }catch (\Exception $e){

            }

            return  back();
        }else{
            abort(404);
        }

    }

    public function getUpdatePassword(){
        return view('auth.passwords.reset-password');
    }

    public function updatePassword(Request $request){
        $this->validate($request,[
            'mobile_confirmation'   => 'required',
            'email'   => 'required',
            'password' => 'required|string|min:2|confirmed',
//            'time'=>'required|string',
        ]);


        $user = User::where('confirmation_code',$request->mobile_confirmation)->where('email',$request->email)->first();

        if($user){
            $user->password = Hash::make($request->password);
            $user->confirmation_code = null;
            $user->save();
            alert()->success('تم تعيين كلمة سر جديده')->autoclose(6000);
            return redirect()->route('login');
        }else{
            alert()->warning('خطأ في البيانات')->autoclose(6000);
        }

    }

    public function sendEmail(Request $request){

        $email = $request->email;
        $user = User::where('email',$email)->first();
        if($user){
            $user->confirmation_code=mt_rand(1000,9999);
            $user->save();
            try {


                $msg=" كود إعادة تفعيل كلمة السر الخاص بك من باكيج (Package) هو  :  $user->confirmation_code";
                $MsgID = rand(1,99999);
                $numbers = $user->phone;
                sendSMS($msg, $numbers, $MsgID);


                $data = array('code' => $user->confirmation_code);

                Mail::send('emails.verification_code', $data, function ($message) use ($user) {
                    $message->to($user->email, 'كود التفعيل')->subject
                    ('كود التفعيل');
                    $message->from('info@sheari.net', 'Package');
                });
            }catch (\Exception $e){

            }
            alert()->success('تم ارسال كود اعادة تعيين كلمة السر علي البريد ')->autoclose(60000);
            return redirect()->route('update-password');
        }else{
            alert()->warning('هذا البريد غير مستخدم ')->autoclose(6000);
            return redirect()->back();
        }

    }

    public function ActiveEmail(){

        return view('auth.passwords.send-active');
    }


    public function sendActiveEmail(Request $request){


        $email = $request->email;

        $user = User::where('email',$email)->first();
        if($user){

            $user->confirmation_code=mt_rand(1000,9999);
            $user->save();


            try {

                $msg=" كود إعادة تفعيل كلمة السر الخاص بك من باكيج (Package) هو  :  $user->confirmation_code";
                $MsgID = rand(1,99999);
                $numbers = $user->phone;
                sendSMS($msg, $numbers, $MsgID);



                $data = array('code' => $user->confirmation_code);

                Mail::send('emails.verification_code', $data, function ($message) use ($user) {
                    $message->to($user->email, 'كود التفعيل')->subject
                    ('كود التفعيل');
                    $message->from('info@sheari.net', 'Package');
                });
            }catch (\Exception $e){

            }

            alert()->success('تم ارسال رمز التفعيل على البريد المرسل بنجاح  ')->autoclose(60000);
            return redirect()->route('active');
        }else{
            alert()->warning('هذا البريد غير مستخدم ')->autoclose(60000);
            return redirect()->back();
        }

    }

    public function addOffer(Request $request) {
        $this->validate($request,[
            'title' => 'required|string|',
            'type' => 'required|string|',
            'description' => 'required|string|',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'attachment' => 'file',
            'time_count' => 'required|string',
        ]);

        $inputs=$request->all();
        $inputs['user_id']=auth()->id();
        //$image = uploadImageWithCompress($request,'image',300,300);

        $image = $request->file('image');
        $filename = 'image_'.time();

        $image = Image::make($image)
            ->encode('webp', 90)
            ->resize(200, 200)
            ->save(\Storage::disk('public')->path(uploadpath() .'/'.  $filename . '.webp'));

        $inputs['image'] = 'photos/'.$filename . '.webp';

        if($request->hasFile('attachment')){
            $attachment= uploader($request,'attachment');
            $inputs['attachment']=$attachment;
        }



        Ad::create($inputs);
        alert()->success('تم اضافة   بنجاح !')->autoclose(5000);
        return  back();
    }

    public function addComment(Request $request,$id) {
        $this->validate($request,[
            'comment' => 'required|string',
        ]);


        $inputs=$request->all();
        $inputs['user_id']=auth()->id();
        $inputs['ads_id']=$id;
        Comment::create($inputs);
        alert()->success('تم اضافة   بنجاح !')->autoclose(5000);
        return  back();
    }

    public function addContact(Request $request) {

        $this->validate($request,[
            'name' => 'required|string|',
            'email' => 'required|string|email',
            'phone' => 'required',
            'message' => 'required|string|',
            'type' => 'required|string|',

         ]);
        if ($request->faxonly) {

            alert()->success('وصلت رسالتكم .. سنهتم بذلك .. سعداء بخدمتكم ..')->autoclose(5000);
            return  back();
        }

        $inputs=$request->all();
        $inputs['user_id']=auth()->id();

        if($request->hasFile('file')){
            $attachment= uploader($request,'file');
            $inputs['file'] = $attachment;
        }
        Contact_Us::create($inputs);

        alert()->success('وصلت رسالتكم .. سنهتم بذلك .. سعداء بخدمتكم ..')->autoclose(5000);
        return  back();


    }


    public function addAds(Request $request) {

        $this->validate($request,[
            'title' => 'required|string|',
            'description' => 'required|string|',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'ads_category_id' => 'required|string|',
         ]);

        $inputs=$request->all();
        $inputs['user_id']=auth()->id();
        $image = uploadImageWithCompress($request,'image',600,600);
        $inputs['image']=$image;
        Advertisement::create($inputs);
        alert()->success('تم اضافة   بنجاح !')->autoclose(5000);
        return view('user.add-ads');
    }

    public function searchAds(Request $request) {
        $query = Advertisement::query();


        $query->when(isset($request['keyword']), function ($q)use ($request) {
            return $q->where('title', 'LIKE',  $request['keyword'] );
         });

        $query->when(isset($request['category_id'])  ,function ($q) use ($request) {
              return $q->where('ads_category_id',  $request['category_id'] );

        });

        $ads =$query->get();

        return view('site.ads',['ads'=>$ads]);
    }

    public function searchProvider(Request $request) {
        $query = User::query();
        $query->where('role','provider')->where('is_verified',1);
        $query->when(isset($request['category_id']),function ($q) use ($request) {
            if($request['category_id']!=''){
              $users=SubCategory::findOrFail($request['category_id'])->UsersIds();
            return $q->whereIn('id',  $users);
        }
        });
        $query->when(isset($request['city_id']),function ($q) use ($request) {
            if($request['city_id']!='')
            {
                $users = City::findOrFail($request['city_id'])->usersId();

                return $q->whereIn('id',  $users);
            }
        });
        $query->when(isset($request['country_id']),function ($q) use ($request) {
            if($request['country_id']!='')
            {
            if(isset($request['city_id'])){
                return $q;
            }
            else{
                $cities=Country::findOrFail($request['country_id'])->cities;
                $users=[];

                foreach ($cities as $city){
                    if($city->usersId()){
                        foreach ($city->usersId() as $item){
                            array_push($users,$item);
                        }


                    }
                }


            $users=array_unique($users);
            return $q->whereIn('id',  $users);
            }}
        });
        $providers=$query->orderBy('is_top','DESC')->paginate(24);
        return view('site.single_service',['providers'=>$providers]);
    }


    public function marketRequest() {
        $ads=Ad::where('type','order')->paginate();
        return view('user.market-request',['ads'=>$ads]);
    }
    public function marketRequestSearch(Request $request) {
        $ads=Ad::where('type','order')->where('title', 'LIKE',  $request['keyword'])->paginate();
        return view('user.market-request',['ads'=>$ads]);
    }

    public function marketOffer() {

        $ads=Ad::where('type','offer')->paginate();
        return view('user.market-offer',['ads'=>$ads]);
    }

    public function marketOfferSearch(Request $request) {

        $ads=Ad::where('type','offer')->where('title','LIKE',"%{$request['keyword']}%")->paginate();
        return view('user.market-offer',['ads'=>$ads]);
    }



    public function marketShow($id) {
        $ads=Ad::findOrFail($id);
        $ads->views=$ads->views+1;
        $ads->save();
        return view('user.singile-market',['ad'=>$ads]);
    }

    public function clientRegister () {
        return view('auth.client-register');
    }

    public function providerRegister () {
        return view('auth.provider-register');
    }

    public function myAccount(){

        $user = \Auth::user();

        if($user->role == 'client'){
            return view('user.client.my-account_client')->with('client',$user);
        }elseif ($user->role == 'provider'){
            return view('user.provider.my-account_provider')->with('provider',$user);
        }
    }

    public function myProjects(){
        $user = \Auth::user();

        if($user->role == 'client'){
            return redirect()->back();
            //return view('user.client.my-account_client')->with('client',$user);
        }elseif ($user->role == 'provider'){
            $projects =  ProviderProject::where('user_id',$user->id)->get();
            return view('user.provider.projects')->with('projects',$projects);
        }
    }

    public function editMyAccount (){
        $user = \Auth::user();

        if($user->role == 'client'){
            return view('user.client.edit-my-account_client')->with('client',$user);
        }elseif ($user->role == 'provider'){
            return view('user.provider.edit-my-account_provider')->with('provider',$user);
        }
    }

    public function editProject($id){
        $project = (ProviderProject::find($id));

        return view('user.provider.edit-my-project')->with('project',$project);
    }

    public function saveProject($id,Request $request){
        $project = (ProviderProject::find($id));

        $this->validate($request,[
            'title' => 'required|string|',
            'price' => 'nullable|integer',
            'description' => 'required|string|',
            'file' => 'nullable|mimes:jpg,jpeg,gif,png|max:2048',
            'file_type' => 'required',

        ],[
            'file.max'           => 'حجم الصور المسموح به هو  2  ميقا كحد أقصى',
            'file_type.required'    => 'مطلوب قيمة حقل نوع المشروع'
        ]);


        $project->title = $request->title;
        $project->price = $request->price;
        $project->file_type = $request->file_type;
        $project->description = $request->description;
        if($request->hasFile('file')){
            deleteImg($project->file);
            $image = uploadImageWithCompress($request,'file',300,350);
            $project->file = $image;
        }

        if($project->save()){
            //alert()->success('تم التعديل !')->autoclose(5000);
            \Session::flash('success','تم تعديل البيانات بنجاح');
            alert()->success('تم تعديل البيانات بنجاح !')->autoclose(5000);
            return redirect()->route('user.myProjects');
        }

    }

    public function addProject(){
        return view('user.provider.add-project');
    }
    public function SaveNewProject(Request $request){
        $user =  auth()->user();
        $this->validate($request,[
            'title' => 'required|string|',
            'price' => 'nullable|integer',
            'description' => 'required|string|',
            'file'   =>'nullable|mimes:jpg,jpeg,png|max:2048',
            'file_type' => 'required',
        ],[
            'file.max'           => 'حجم الصور المسموح به هو  2  ميقا كحد أقصى',
            'file_type.required'    => 'مطلوب قيمة حقل نوع المشروع'
        ]);
        //

        $project = new ProviderProject();
        $project->user_id = $user->id;
        $project->price = $request->price;
        $project->title   =  $request->title;
        $project->file_type   =  $request->file_type;

        if($request->hasFile('file')){
            $project->file    = uploadImageWithCompress($request,'file',300,350);
        }else{

            $project->file    = "photos/default.png";
        }

        $project->description = $request->description;

        if($project->save()){
            alert()->success('تم اضافة العمل بنجاح !')->autoclose(5000);
            return redirect()->route('user.myProjects');
        }
    }

    public function removeProject($id){
        $user =  auth()->user();
        if($user){
            $project = ProviderProject::where('id',$id)->first();
            deleteImg($project->file);
            $project->delete();
            alert()->success('تم مسح العمل بنجاح !')->autoclose(5000);
            return redirect()->route('user.myProjects');

            //return redirect()->route('user.myAccount');
        }else{
            alert()->success('تأكد من تسجيل الدخول')->autoclose(5000);

            return redirect()->route('user.myAccount');

        }
    }

    public function changePassword (Request $request){
        $user = \Auth::user();
        $this->validate($request,[
            'old_password' => 'required|string|',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if(Hash::check($request->old_password,$user->password)){
            $user->update(['password'=>Hash::make($request->password)]);
            \Session::flash('success','تم تعديل البيانات بنجاح');
            alert()->success('تم تعديل بيانات   بنجاح !')->autoclose(5000);
            return back();
        }

        \Session::flash('error','كلمة المرور غير صحيحة');
        alert()->error('كلمة المرور غير صحيحة !')->autoclose(5000);
        return back();
    }

    public function password(){

        return view('user.password');
    }

    public function saveClient(Request $request){

        //dd($request->all());
        $user = \Auth::user();

        $checked = (substr($request->phone,0,1));


        if ($checked == "0"){

            $phone =  substr($request->phone,1);

        }else{
            $phone = $request->phone;
        }

        $user = auth()->user();

        $code = substr($user->phone,0,3);



        $phone = $code . $phone;
        // check user
        $exiting  = User::where('phone',$phone)->where('id','!=',$user->id)->first();

        if($exiting){
            alert()->info('الجوال مستخدم في حساب اخر')->autoclose(50000);
            return redirect()->back();
        }

//      $user->update($request->all());
        $user->name = $request->name;
        $user->phone = $phone;
        $user->bio = htmlentities($request->bio);
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->job = $request->job;
        $user->charitable = $request->charitable;
        $user->map = $request->map;
        $user->delivery = $request->delivery;
        if ($request->commerical){
            $user->commerical_no = $request->commerical_no;
        }else{
            $user->commerical_no = null;
        }
        if ($request->account_maroof){
            $user->account_maroof = $request->account_maroof;
        }else{
            $user->account_maroof = 'no';
        }

        if ($request->account_freelancer){
            $user->account_freelancer = $request->account_freelancer;
        }else{
            $user->account_freelancer = 'no';
        }

        $user->qualifications = $request->skills;
        //$user->qualifications = $request->skills;
        $user->discount = $request->discount;


        if($request->hasFile('image')){
            deleteImg($user->image);
            //$image = uploadImageWithCompress($request,'image',150,150);

            $image = $request->file('image');
            $filename = 'image_'.time();

            $image = Image::make($image)
                ->encode('webp', 90)
                ->resize(200, 200)
                ->save(\Storage::disk('public')->path(uploadpath() .'/'.  $filename . '.webp'));

            $user->image =  'photos/'.$filename . '.webp';
        }

        if(isset($request->sub_category_id)){

            $select = UserSubCategory::where('sub_category_id',$request->sub_category_id)->where('user_id',$user->id)->first();
            if(!$select){
                $subCategories = new UserSubCategory();
                $subCategories->sub_category_id = $request->sub_category_id;
                $subCategories->user_id         = $user->id;
                $subCategories->created_at      = Carbon::now();
                $subCategories->save();
            }

        }

        if($user->save()){
            alert()->success('تم تعديل البيانات بنجاح !')->autoclose(5000);

            if ($user->device_token){
                sendNotification($user->device_token,'تعديل البيانات',"تم تعديل البيانات");
            }
            //\Session::flash('success','تم تعديل البيانات بنجاح');
            return redirect()->back();
        }

    }

    public function verify(){
        return view('auth.verify');
    }

    public function activeAccount(Request $request){

        $activation_code = $request->activation_code;
        $user = User::where('activation_code',$activation_code)->first();
        if($user){
            $user->is_verified = 1;
            $user->save();

        }

        return $user;
        // select where active code is true


    }



    public function userCard(){
        return view('user.user-card');
    }

    public function rateProvider(Request $request){

        $order = Order::find($request->order_id);

        if(!$order->rate == null){
            alert()->info('لقد قيمت مزود الخدمة من قبل')->autoclose(5000);
            return redirect()->back();
        }
        if($order){
           $order->rate = $request->rate;
           $order->comment = $request->comment;

           $order->save();
            $notfication = new \App\Models\Notification();
            $notfication->title="تقييم علي الطلب";
            $notfication->type='order';
            $notfication->item_id=$order->id;
            $notfication->notification_status='finished';
            $notfication->user_id=$order->provider_id;
            $notfication->save();

            alert()->success('لقد قيمت مزود الخدمة اﻷن')->autoclose(5000);
           return redirect()->back();
        }else{
            alert()->warning('تأكد من الطلب')->autoclose(5000);
            return redirect()->back();
        }

    }





    ////// events design functions /////////////////////////////


    public function designEvents(){

        //return view('user.design');
        $categories = Cat_Event::all();


        //alert()->info('نذكر بدفع (5 ريال) فقط مقابل الحصول علي البطاقة الواحدة.')->autoclose(6000);
        return view('user.design_events.index',compact('categories'));

    }

    public function designEventsSubCategories(Request $request){



        $images = Event::where('sub_cat_id','=',$request->sub_cat_id)->get();

        return view('user.design_events.designs',compact('images'));

    }


    public function singleEevnt($id){

        $single = Event::find($id);

        return view('user.design_events.single_event',compact('single'));

    }



    // delete subcategoris

    public function providerDeleteSubCategories(Request $request){

        $sub_category_id = $request->sub_category_id;
        $user_id = $request->user_id;

        $subCategoryUser = UserSubCategory::where('sub_category_id',$sub_category_id)->where('user_id',$user_id)->first();


        if($subCategoryUser->delete()){
            alert()->info('تم مسح المجال بنجاح!')->autoclose(5000);
        }else{
            alert()->info('تأكد من وجود المجال لديك!')->autoclose(5000);

        }

        return redirect()->back();
    }

    public function providerDeleteAdsCategories(Request $request){
        $user_id = $request->user_id;

        $provider = User::find($user_id);

        if($provider){

            if($provider->ads_category){
                $provider->ads_category = null;
                $provider->save();
                alert()->info('تم مسح المجال بنجاح!')->autoclose(5000);

            }else{
                alert()->info('تأكد من وجود المجال لديك!')->autoclose(5000);
            }

        }else{
            alert()->info('تأكد من وجود المجال لديك!')->autoclose(5000);

        }


        return redirect()->back();
    }


    public function saveToken(Request $request){

        auth()->user()->update(['device_token'=>$request->token]);

        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {

        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();




        $SERVER_API_KEY = 'AAAAq2dTeSA:APA91bG0qImTuLrEI5KBaJII5tNnxCBb1Y92irWAjX18CD1ia0_G0vxhW3DFeCBmdnb2tRw8FCrNEa88Vur-9Q3sZAQd195XmdEkWp-VbqN9gya63orKq_n8mF90nm6cY30LazISg-YA';



        $data = [

            "registration_ids" => $firebaseToken,

            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                'sound' => "default",
                'color' => "#203E78"
            ]

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];



        $ch = curl_init();



        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);



        $response = curl_exec($ch);



        //return ($response);

    }






}
