<?php
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

function printStringResult($apiResult, $arrayMsgs, $printType = 'Alpha')
{
    global $undefinedResult;
    switch ($printType)
    {
        case 'Alpha':
            {
                if(array_key_exists($apiResult, $arrayMsgs))
                    return $arrayMsgs[$apiResult];
                else
                    return $arrayMsgs[0];
            }
            break;

        case 'Balance':
            {
                if(array_key_exists($apiResult, $arrayMsgs))
                    return $arrayMsgs[$apiResult];
                else
                {
                    list($originalAccount, $currentAccount) = explode("/", $apiResult);
                    if(!empty($originalAccount) && !empty($currentAccount))
                    {
                        return sprintf($arrayMsgs[3], $currentAccount, $originalAccount);
                    }
                    else
                        return $arrayMsgs[0];
                }
            }
            break;

        case 'Senders':
            {
                $apiResult = str_replace('[pending]', '[pending]<br>', $apiResult);
                $apiResult = str_replace('[active]', '<br>[active]<br>', $apiResult);
                $apiResult = str_replace('[notActive]', '<br>[notActive]<br>', $apiResult);
                return $apiResult;
            }
            break;

        case 'Normal':
            if($apiResult[0] != '#')
                return $arrayMsgs[$apiResult];
            else
                return $apiResult;
            break;
    }
}

function sendNotifications($title, $body, $tokens, $data = [] , $is_notification = true)
{
  $fcmUrl = "https://fcm.googleapis.com/fcm/send";
  $serverKey ='AAAA-6tfXd8:APA91bGltLQx7dBC3dsnBTzCfO1hxdGwxKunNYqBoFSlnP6YXe-OWYekG_Ik-8CaWbDoUzDQEGRtL1QRtn1OADLsxSgrjcczmjTdgLmhIIFjC_lw_LvH_OLZVkzr0BWyR9VasNu8amIv';

  $notification = [
//           'title' =>'',
            'body' => $body,
//      'icon' =>'#',
      'sound' => 'mySound',
      'badge' => '1'
  ];
//   $extraNotificationData = ["message" => $notification,'type'=>$type];
  $fcmNotification = [
//      'registration_ids' => $token, //multple token array
      'to'        => $tokens, //single token
      'notification' => $notification,
      'data' => $data,
      'priority'=>'high'
  ];

  $headers = [
      'Authorization: key=' .$serverKey,
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

}


function sendSMS($body_data,$number,$msg_id)
{
    //Results of Send SMS API, in text format
    /*
    if($viewResult)
    $result = printStringResult(trim($result) , $arraySendMsg);
    */


    $token = "1a73ec95166d4c9a9dda6c1d1b2f7198";
    $url="https://api.taqnyat.sa/v1/messages";

    //Sender Name must be pre approved by the operator before being used
    //يجب ان يتم الموافقة على اسم المرسل من قبل مزود الخدمة قبل البدئ باستخدامه
    $sender = "Package";

    //You may send message to 1 destination or multiple destinations by supply destinations number in one string and separate the numbers with "," or provide a array of strings
    //يمكنك ارسال الرسائل الى جهة واحدة من خلال او اكثر تزويدنا بالارقام في متغير نصي واحد تكون فيه الارقام مفصولة عن بعضها باستخدام "," او من خلال تزويدنا بمصفوفة من الارقام
    $recipients = array($number);

    //The message Content in UTF-8
    //نص الرساله مشفر ب UTF-8
    $body = $body_data;

    $customRequest="POST"; //POST or GET
    $data = array(

        'bearerTokens'=> $token,
        'sender'=> $sender,
        'recipients'=> $recipients,
        'body'=> $body,
    );

    $data=json_encode($data);

    $curl = curl_init();


    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $customRequest,
        CURLOPT_POSTFIELDS=>$data,
        CURLOPT_HTTPHEADER=> array('Content-Type:application/json'),
    ));


    $response = curl_exec($curl);
    $result = $response;
    /*$bearer = 'f5d7808a0e272bfd93f6154451c32637';
    $taqnyt = new TaqnyatSms($bearer);
    $body = $body_data;
    $recipients = [$number];
    $sender = 'Sheari';
    $smsId = $msg_id;
    $result =$taqnyt->sendMsg($body, $recipients, $sender, $smsId);*/
    return $result;

}

/**
 * Setting Name
 * @param $name
 * @return mixed
 */
function getsetting($name)
{
    $setting=\App\Models\Setting::where('name',$name)->first();
    if (!$setting) return "";
    return $setting->value();
}
/**
 * Upload Path
 * @return string
 */
function uploadpath()
{
    return 'photos';
}

/**
 * Get Image
 * @param $filename
 * @return string
 */

function getimg($filename)
{

    // Check if the image URL is cached
    $cacheKey = 'image_url_' . $filename;
    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }
    // If not cached, generate the image URL
    $base_url = url('/');
    $imageUrl = '';

    if ($filename) {
        // Construct the full image URL
        $imageUrl = 'https://package.sa/storage/' . $filename;

        // Check server response time
        $response = Http::head($imageUrl);

        if ($response->successful()) {
            // Cache the image URL for future use
            Cache::put($cacheKey, $imageUrl, now()->addHours(24)); // Adjust the cache expiry time as needed
        } else {
            // Use placeholder image URL
            $imageUrl = $base_url . '/profile-placeholder.png';
        }
    } else {
        // If no filename is provided, use a placeholder image
        $imageUrl = $base_url . '/profile-placeholder.png';
    }

    return $imageUrl;
}


function updateImageToWebP($filename)
{
    // Construct the full local file path for the image using storage_path()
    $imagePath = public_path('storage/' . $filename);
    $base_url = url('/');

    // Check if the image file exists locally
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if(!empty($extension)){

    if (File::exists($imagePath)) {
        // Load the image using Intervention Image
        $image = Image::make($imagePath);

        $image->encode('webp');

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Save the image with the new extension in the public storage directory
        $newFilename = str_replace('.' . $extension, '.webp', $filename);
        $newImagePath = public_path('storage/' . $newFilename);
        $image->save($newImagePath);

        // Save the image with the new extension in the storage/app/public/ directory
        $storageImagePath = storage_path('app/public/' . $newFilename);
        $image->save($storageImagePath);

        // Return the updated filename
        return 'https://package.sa/storage/'.$newFilename;
    } else {
        // Return the original filename if the image file doesn't exist
         return 'https://package.sa/storage/'.$filename;
    }
    }else{

                return  $base_url.'/profile-placeholder.png';

    }

}



/**
 * Delete Image
 * @param $filename
 * @return string
 */
function deleteImg($filename)
{
    $base_url = url('/');

    if($filename) {

        $file = public_path() . '/storage/' . $filename;
        if (file_exists($file)) {
            \Illuminate\Support\Facades\File::delete($file);
            return true;
        }


        return false;
    }

    return false;
}

/**
 * Upload an image
 * @param $img
 */
function uploader($request,$img_name)
{
    $path = \Storage::disk('public')->put(uploadpath(), $request->file($img_name));

    return $path;
}

function uploadImageWithCompress($request,$image,$width,$height){
    $image = $request->file($image);

    $filename = 'image_'.time();
    $filePath = 'photos/' . $filename . '.webp';




    //$img_resize->save(storage_path('photos').'/' . $file);
    //$img_resize->save(\Storage::disk('public')->put(uploadpath()), $img_resize->resize(250,250));

    //Storage::disk('uploads')->put('filename', $img_resize->save(storage_path() . $file););

\Storage::disk('public')->put($filePath, File::get($image));
    //\Storage::disk('public')->put(uploadpath(), $img_resize->save());
                    $picture = 'photos/'.$filename . '.webp';

    return  $picture;

}


function uploadBanner($request,$image)
{
    $image = $request->file($image);

    $file = time() . '.' . $image->getClientOriginalExtension();

    $img_resize = Intervention\Image\Facades\Image::make($image->getRealPath());


    //$img_resize->save(storage_path('photos').'/' . $file);
    //$img_resize->save(\Storage::disk('public')->put(uploadpath()), $img_resize->resize(250,250));

    //Storage::disk('uploads')->put('filename', $img_resize->save(storage_path() . $file););

    ($img_resize->save(\Storage::disk('public')->path(uploadpath() . '/' . $file)));

    //\Storage::disk('public')->put(uploadpath(), $img_resize->save());
    return 'photos' . '/' . $file;

}

    function status()
{
    $array = [
        '1'=>'مفعل',
        '0'=>'غير مفعل',
    ];
    return $array;
}

function OrderStatus($status = null)
{
    if (auth()->user()->role=='client')
    {
        $collect = [
            'pending'=>'طلب جديد',
            'canceled'=>'تم إلغاؤه',
            'finished'=>'تم الانتهاء منه',
            'accepted'=>'جاري العمل علية',
        ];

    }
    else{
        $collect = [
            'pending'=>' طلب جديد',
            'canceled'=>'تم إلغاؤه',
            'finished'=>'تم الانتهاء',
            'accepted'=>'جارى العمل عليه',
        ];
    }
    if ($status == null)
        return $collect;

    return $collect[$status];
}

function IsActive($status = null)
{
    $collect = [
        '1'=>'مفعل',
        '0'=>'غير مفعل',

    ];
    if ($status == null)
        return $collect;

    return $collect[$status];
}
function gender($status = null)
{
    $collect = [
        'male'=>'ذكر',
        'female'=>'أنثى',

    ];
    if ($status == null)
        return null;

    return $collect[$status];
}


function category()
{
    $categories = App\Models\Category::all()->mapWithKeys(function ($item) {
        return [$item['id'] => $item['ar_name']];
    });
    return $categories;
}
function categories(){

    $categories = App\Models\Category::all();
    return $categories;
}
function ad_category()
{
    $categories = App\Models\AdsCategory::all()->mapWithKeys(function ($item) {
        return [$item['id'] => $item['ar_name']];
    });
    return $categories;
}
function adscategory()
{
    $categories = App\Models\AdsCategory::all()->mapWithKeys(function ($item) {
        return [$item['id'] => $item['ar_name']];
    });
    return $categories;
}

function subCategory($category_id = null)
{
    if($category_id!=null){
        $subcategories = App\Models\Category::find($category_id)->subCategories->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }else{
        $subcategories = App\Models\SubCategory::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }
    return $subcategories;
}

function services($subcategory_id = null)
{
    if($subcategory_id!=null){
        $services = App\Models\SubCategory::find($subcategory_id)->services->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }else{
        $services = App\Models\Service::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }
    return $services;
}
function countries()
{
    $countries = App\Models\Country::all()->mapWithKeys(function ($item) {
        return [$item['id'] => $item['ar_name']];
    });
    return $countries;
}
function nationalities()
{
    $countries = App\Models\Nationality::all()->mapWithKeys(function ($item) {
        return [$item['ar_name'] => $item['ar_name']];
    });
    return $countries;
}

function qualifications()
{
    $countries = App\Models\Qualification::all()->mapWithKeys(function ($item) {
        return [$item['ar_name'] => $item['ar_name']];
    });
    return $countries;
}

function cities($country_id = null)
{
    if($country_id!=null){
        $cities = App\Models\Country::find($country_id)->cities->orderBy('ar_name')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }else{
        $cities = App\Models\City::orderBy('ar_name')->get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }
    return $cities;
}

function regions($city_id = null)
{
    if($city_id!=null){
        $regions = App\Models\City::find($city_id)->regions->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }else{
        $regions = App\Models\Region::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
    }
    return $regions;
}



function notificationTarget(){
    $target = [
        'client'=>'عميل',
        'provider'   =>  'مزود خدمة',
        'all_users'=>'كل المستخدمين',

    ];
    return $target;
}

function sendTarget(){
    $target = [
        'client'=>'عميل',
        'provider'   =>  'مزود خدمة',
        'providerTypes'   =>  'الافسام الرئيسية',
        'providerAds'   =>  'الاعلانات ',
        'all_users'=>'كل المستخدمين',
    ];
    return $target;
}




function sendType(){
    $target = [
        'sms'=>'رسالة نصية',
        'whatsapp'=>'واتساب',
        'email'   =>  'بريد الكتروني',
        'all'=>'رسالة نصية وبريد الكتروني',
    ];
    return $target;
}
function sendMessageHiWhats($numbers, $message)
{
    $url = 'https://hiwhats.com/API/send';
    $mobile = '966506601144';
    $password = '152d38465';
    $instanceid = '20133';
    $json = '1';
    $type = '1';
    $data = [
        'mobile' => $mobile,
        'password' => $password,
        'instanceid' => $instanceid,
        'message' => $message,
        'numbers' => $numbers,
        'json' => $json,
        'type' => $type,
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);


    // Check for cURL errors or handle the response as needed
    if (curl_errno($ch)) {
        // Handle cURL error
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        // Process the response

        echo 'Response: ' . $response;
    }

    curl_close($ch);
}


function sendFileHiWhats($numbers, $message, $fileUrl)
{
    $url = 'https://hiwhats.com/API/send';
    $mobile = '966506601144';
    $password = '152d38465';
    $instanceid = '20133';
    $json = '1';
    $type = '2'; // Set type to 2 for sending files
    $data = [
        'mobile' => $mobile,
        'password' => $password,
        'instanceid' => $instanceid,
        'message' => $message,
        'numbers' => $numbers,
        'json' => $json,
        'type' => $type,
        'fileurl' => $fileUrl, // Include the file URL in the request
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);

    // Check for cURL errors or handle the response as needed
    if (curl_errno($ch)) {
        // Handle cURL error
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        // Process the response
        echo 'Response: ' . $response;
    }

    curl_close($ch);
}


function GenerateCode() {
    $code = str_random(6); // better than rand()
    // call the same function if the barcode exists already
    if (UniqueCode($code)) {
        return GenerateCode();
    }
    // otherwise, it's valid and can be used
    return $code;
}

function sGendSms($messsage,$phone) {


    $messsage = urlencode($messsage);
    $url = "http://api.yamamah.com/SendSMSV2?Username=0562261881&Password=Aa@1455555523456&Tagname=Khadoom&RecepientNumber=$phone&VariableList=&ReplacementList=&Message=$messsage&SendDateTime=0&EnableDR=false";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);



    // otherwise, it's valid and can be used
    return '';
}

function UniqueCode($code)
{
    return \App\Models\Coupon::where('code',$code)->first();
}

function multiUploader($request,$img_name,$onId=null){
    $images= [];
    $i = 0;
    foreach ($request[$img_name] as $image){
        $path = \Storage::disk('public')->putFile(uploadpath(), $image);
        $images[$i] = $path;
        $i++;
    }
    return $images;
}

function multipleUploaderJson($request, $img_name, $model, $options = [])
{
    foreach ($request->$img_name as $key => $item) {
        $photo = \Illuminate\Support\Facades\Storage::disk('public')->putFile(uploadpath(), $item);
        $items[$key] = $model([
            $img_name => $photo
        ], $options);
    }

}


function fix_null($data){
    return blank($data)?0:$data;
}


/*get notification image*/
function getNotificationImage($type,$notification_status){

    if($type == 'order'){

        if($notification_status == 'pending')
            return asset('/img/order_status/01-1.png');
        elseif ($notification_status == 'canceled')
            return asset('/img/order_status/01-3.png');
        elseif ($notification_status == 'finished')
            return asset('/img/order_status/01-4.png');
        elseif ($notification_status == 'accepted')
            return asset('/img/order_status/01-2.png');
        elseif ($notification_status == 'price_updated')
            return asset('/img/order_status/01-4.png');
        else
            return null;
    }

    return null;



}




/*get notification image*/
function getOrderImage($order_status){

    if($order_status == 'pending')
            return asset('/img/order_status/01-1.png');
    elseif ($order_status == 'canceled')
        return asset('/img/order_status/01-3.png');
    elseif ($order_status == 'finished')
        return asset('/img/order_status/01-4.png');
    elseif ($order_status == 'accepted')
        return asset('/img/order_status/01-2.png');
    else
        return null;
}

function sendNotification($device_token,$title,$body)
{

    $firebaseToken = [$device_token];


    // $SERVER_API_KEY = 'AAAAq2dTeSA:APA91bG0qImTuLrEI5KBaJII5tNnxCBb1Y92irWAjX18CD1ia0_G0vxhW3DFeCBmdnb2tRw8FCrNEa88Vur-9Q3sZAQd195XmdEkWp-VbqN9gya63orKq_n8mF90nm6cY30LazISg-YA';
 $SERVER_API_KEY='AAAA-6tfXd8:APA91bGltLQx7dBC3dsnBTzCfO1hxdGwxKunNYqBoFSlnP6YXe-OWYekG_Ik-8CaWbDoUzDQEGRtL1QRtn1OADLsxSgrjcczmjTdgLmhIIFjC_lw_LvH_OLZVkzr0BWyR9VasNu8amIv';



    $data = [

        "registration_ids" => $firebaseToken,

        "notification" => [
            "title" => $title,
            "body" => $body,
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

    return $response;

}

function sendSingleNotification($token,$title,$body){

//  $API_ACCESS_KEY='AAAAq2dTeSA:APA91bG0qImTuLrEI5KBaJII5tNnxCBb1Y92irWAjX18CD1ia0_G0vxhW3DFeCBmdnb2tRw8FCrNEa88Vur-9Q3sZAQd195XmdEkWp-VbqN9gya63orKq_n8mF90nm6cY30LazISg-YA';
 $API_ACCESS_KEY='AAAA-6tfXd8:APA91bGltLQx7dBC3dsnBTzCfO1hxdGwxKunNYqBoFSlnP6YXe-OWYekG_Ik-8CaWbDoUzDQEGRtL1QRtn1OADLsxSgrjcczmjTdgLmhIIFjC_lw_LvH_OLZVkzr0BWyR9VasNu8amIv';

 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

    $notification = [
        'title' =>$title,
        'body' => $body,
        'icon' =>'',
        'sound' => 'mySound'
    ];

        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . $API_ACCESS_KEY,
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
