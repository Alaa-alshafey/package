<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\AdsCategory;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Chat;
use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdsCategoryResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\chatCollection;
use App\Http\Resources\chatSingle;
use App\Http\Resources\CommentResource;
use App\Http\Resources\InboxResource;
use App\Http\Resources\MarketResource;
use App\Http\Resources\MarketSingleResource;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\QualificationResource;
use App\Http\Resources\SingleInboxResource;
use App\Http\Resources\SlideResource;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponses;
use App\Models\Inbox;
use App\Models\Order;
use App\Models\Qualification;
use App\Models\Report;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;


class HomeController extends Controller
{
    use ApiResponses;

    public function GetAllCategory()
    {


        $categories = Category::orderBy('view_number','asc')->get();

        $categories->each(function($category){

            if($category->image_price){
                $category->image_price = getimg($category->image_price);
            }else{
                $category->image_price = $category->image_price;
            }

        });
        $countries = CategoryResource::collection($categories);


        return $this->apiResponse($countries);

        if (request()->getHttpHost() != "dev.sheari.net"){


            $categories = Category::all();
            $countries = CategoryResource::collection($categories);

            return $this->apiResponse($countries);

        }

        //$categories = Category::all();
        //$countries = CategoryResource::collection($categories);
        //return $this->apiResponse($countries);

        $topCategories = Category::whereIn('id',[
            1,
            2,
            4,
            5,
            6,
            8,
            13,
            3,

        ])->orderBy('view_number','asc')->get();

        $otherCategories = Category::whereNotIn('id',[
            1,
            2,
            4,
            5,
            6,
            8,
            13,
            3,

        ])->orderBy('view_number','asc')->get();

        $data = [
            'top_categories'    => CategoryResource::collection($topCategories),
            'other_categories'  => CategoryResource::collection($otherCategories),
            ];

        //$countries = CategoryResource::collection($categories);
        return $this->apiResponse($data);

    }

    public function GetAllCategoryMobile()
    {

        $topCategories = Category::whereIn('id',[
            1,
            2,
            4,
            5,
            6,
            8,
            13,
            3,

        ])->get();

        $otherCategories = Category::whereNotIn('id',[
            1,
            2,
            4,
            5,
            6,
            8,
            13,
            3,

        ])->get();

        $data = [
            'top_categories'    => CategoryResource::collection($topCategories),
            'other_categories'  => CategoryResource::collection($otherCategories),
        ];

        //$countries = CategoryResource::collection($categories);
        return $this->apiResponse($data);

    }




    public function orderTitles(){

        $arr = [
            'إنشاء جديد',
            'طلب تصميم',
            'تنفيذ خدمة',
            'تطوير عام',
            'تنظيم برنامج',
            'تعاون',
            'شراكة',
        ];

        return $this->apiResponse($arr);

    }

    public function getAdsCategories(){
        $ads_categories = AdsCategory::all();
        $ads_categories = AdsCategoryResource::collection($ads_categories);
        return $this->apiResponse($ads_categories);
    }

    public function getAdsProviders($ads_category_id){
        $users = User::where('ads_category',$ads_category_id)->get();

        if(count($users) == 0){
            return response()->json([
                'status'    => false,
                'message'   => ' لا يوجد مزودين خدمة حاليا لهذا القسم من الاعلانات'

            ]);
        }
        $users = UserResource::collection($users);

        return $this->apiResponse($users);
    }
    public function GetAllQualification()
    {
        $qualifications = Qualification ::all();
        $qualifications = QualificationResource::collection($qualifications);
        return $this->apiResponse($qualifications);
    }

    public function GetSubCategoryByCategory($id)
    {
        $sub_categoires = SubCategory::where('category_id',$id)->get();
        $sub_categoires = CategoryResource::collection($sub_categoires);
        return $this->apiResponse($sub_categoires);
    }

    public function GetSubCategories()
    {
        $sub_categoires = SubCategory::all();
        $sub_categoires = CategoryResource::collection($sub_categoires);
        return $this->apiResponse($sub_categoires);
    }


    public function getSlideShow(){
        $sliders = Slider::all();
        $sliders = SlideResource::collection($sliders);
        return $this->apiResponse($sliders);

    }

    public function GetServicesByCategory($id)
    {
        $services = Service::where('sub_category_id',$id)->get();
        $services = CategoryResource::collection($services);
        return $this->apiResponse($services);
    }

public function GetProviderBySubCategory($id)
{
    $sub_category = SubCategory::findOrFail($id);

    // Execute the query and retrieve a collection
    $providers = $sub_category->PUsers()->paginate();

    // Transform the collection
    $transformedProviders = $providers->transform(function ($q) {
        // Decode HTML entities
        $decodedString = html_entity_decode($q->bio, ENT_QUOTES | ENT_HTML5);

        // Remove tags using regular expressions
        $cleanString = preg_replace('/<[^>]*>/', '', $decodedString);

        // Extract numbers and words
        $matches = [];
        preg_match_all('/[\p{L}\p{N}]+/u', $cleanString, $matches);
        $result = implode(' ', $matches[0]);

        $result = str_replace('nbsp', '', $result);

        return [
            'id' => $q->id,
            'name' => $q->name,
            'email' => $q->email,
            'phone' => $q->phone,
            'bio' => $result,
            'rate' => $q->rate(),
            'job' => $q->job,
            'isOnline' => $q->isOnline(),
            'image' => getimg($q->image),
            'experience_years' => $q->experience_years,
            'nationality' => $q->nationality,
            'gender' => $q->gender,
            'city_name' => $q->City->name(),
            'country_name' => $q->City->country->name(),
            'discount' => $q->discount,
            'emp_no' => $q->emp_no,
            'created_year' => $q->getCreatedAttribute(),
            'commerical_no' => $q->commerical_no,
            'map' => $q->map,
            'delivery' => $q->delivery,
            'lat' => $q->lat,
            'lng' => $q->lng,
            'charitable' => $q->charitable,
            'provider_type' => $q->provider_type,
            'provider_company_type' => $q->provider_company_type,
            'is_special' => $q->is_special,
            'registration' => $q->registration,
            'sub_categories' => $q->SubCategories,
            'providerCount' => count($q->providerCount),
            'orderCount' => $q->orders()->count(),
            'is_active' => $q->is_active,
            // Add other fields you want to include in the transformation
        ];
    });

    // If you still need the count, you can get it from the transformed collection
    $totalProviders = $transformedProviders->count();

    return $this->apiResponse([
        'providers' => $transformedProviders,
        'paginate' => [
            'total' => $providers->total(),
            'last_page' => $providers->lastPage(),
            'count' => $providers->count(),
            'per_page' => $providers->perPage(),
            'next_page_url' => $providers->nextPageUrl(),
            'prev_page_url' => $providers->previousPageUrl(),
            'current_page' => $providers->currentPage(),
            'total_pages' => $providers->count() != 0 ? ceil($providers->total() / $providers->count()) : 1,
        ],
    ]);
}


    public function GetProviderByCityRegistration(){

        $city_id = \request()->get('city_id',null);
        $sub_category_id = \request()->get('sub_category_id',null);
        if ($sub_category_id && $city_id){
            $sub_category = SubCategory::findOrFail($sub_category_id);
            $providers= $sub_category->UsersIds();
            $providers  = User::whereIn('id',$providers)->where([
                'city_id'   => $city_id,
                'registration'  => 1,
            ])->paginate(20);

        }elseif ($sub_category_id){
            $sub_category = SubCategory::findOrFail($sub_category_id);
            $providers= $sub_category->UsersIds();
            $providers  = User::whereIn('id',$providers)->where([
                'registration'  => 1,
            ])->paginate(20);
        }elseif ($city_id){
            $providers  = User::where([
                'city_id'   => $city_id,
                'registration'  => 1,
            ])->paginate(20);
        }else{
            $providers  = User::where([
                'registration'  => 1,
            ])->paginate(20);
        }

        return $this->apiResponse(new ProviderResource($providers));


    }


    public function GetAdsProviderByCityRegistration(){

        $city_id = \request()->get('city_id',null);
        $ads_category = \request()->get('ads_category',null);
        if ($ads_category  && $city_id){

            $providers  = User::where([
                'ads_category'  => $ads_category,
                'city_id'   => $city_id,
                'registration'  => 1,
            ])->paginate(20);

        }elseif ($ads_category){
            $providers  = User::where([
                'ads_category'  => $ads_category,
                'registration'  => 1,
            ])->paginate(20);
        }elseif ($city_id){
            $providers  = User::where([
                'city_id'   => $city_id,
                'registration'  => 1
            ])->where('ads_category','!=',null)->paginate(20);
        }else{
            $providers  = User::where([
                'registration'  => 1
            ])->where('ads_category','!=',null)->paginate(20);
        }

        return $this->apiResponse(new ProviderResource($providers));


    }

    public function GetProviderByAdsCategory(Request $request)
    {
        $query = User::query();

        $query->where('role','=','provider');
        $query->where('ads_category','!=',null);
        $query->when(isset($request['ads_category']),function ($q) use ($request) {
            if($request['ads_category']!=''){

                return $q->where('ads_category',  $request->get('ads_category'));
            }
        });





        if ($request->get('city_id')){

            $query->when(isset($request['city_id']),function ($q) use ($request) {
                if($request['city_id']!='')
                {
                    $users = City::findOrFail($request['city_id'])->usersId();

                    return $q->whereIn('id',  $users);
                }
            });
        }
        if ($request->get('country_id')){
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
        }



        $providers=$query->orderBy('is_top','DESC')->paginate(15);

        //$sub_categoires = AdsCategory::findOrFail($id);
        //$providers= $sub_categoires->PUsers();
        return $this->apiResponse(new ProviderResource($providers));
    }

    public function GetServicesProviders($id,Request $request)
    {

        $rules = [
            'lat' =>'required|numeric',
            'lng'  =>'required|numeric',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $providers = User::where('role','provider')->select('*')
            ->selectRaw('( 3959 * acos( cos( radians(?) ) *
                                  cos( radians( `lat` ) )
                                  * cos( radians( `lng` ) - radians(?)
                                  ) + sin( radians(?) ) *
                                  sin( radians( `lat` ) ) )
                                ) AS distance',
                [$request->lat, $request->lng, $request->lat])
            ->havingRaw("distance < ?", ['50'])
            ->simplePaginate();


        return $this->apiResponse(new ProviderResource($providers));
    }

    public function GetNearestProviders(Request $request)
    {

        $rules = [
            'lat' =>'required|numeric',
            'lng'  =>'required|numeric',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $providers = User::where('role','provider')->select('*')->selectRaw('( 3959 * acos( cos( radians(?) ) *
                                  cos( radians( `lat` ) )
                                  * cos( radians( `lng` ) - radians(?)
                                  ) + sin( radians(?) ) *
                                  sin( radians( `lat` ) ) )
                                ) AS distance', [$request->lat, $request->lng, $request->lat])
            ->havingRaw("distance < ?", ['50'])
            ->simplePaginate();


        return $this->apiResponse(new ProviderResource($providers));
    }

    public function marketRequest() {
        $ads=Ad::where('type','order')->paginate();
        return $this->apiResponse(new MarketResource($ads));
     }

    public function marketOffers() {
        $ads=Ad::where('type','offer')->paginate();
        return $this->apiResponse(new MarketResource($ads));
    }

    public function marketSingle($id) {
        $ads=Ad::findOrFail($id);
        return $this->apiResponse(new MarketSingleResource($ads));
    }

    public function MarketAddRequest(Request $request){

        $rules = [
            'title' => 'required|string|',

            'description' => 'required|string|',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'attachment' => 'required|file',
            'time_count' => 'required|string',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $inputs=$request->all();
        $inputs['user_id']=auth()->id();
        $inputs['type']='order';
        $image = uploadImageWithCompress($request,'image',300,300);
        $inputs['image']=$image;
        $attachment= uploader($request,'attachment');
        $inputs['attachment']=$attachment;
        $ad=Ad::create($inputs);
        return $this->apiResponse(new MarketSingleResource($ad));

    }
    public function MarketAddOffer(Request $request){

        $rules = [
            'title' => 'required|string|',

            'description' => 'required|string|',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'attachment' => 'required|file',
            'time_count' => 'required|string',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $inputs=$request->all();
        $inputs['user_id']=auth()->id();
        $inputs['type']='offer';
        $image = uploadImageWithCompress($request,'image',300,300);
        $inputs['image']=$image;
        $attachment= uploader($request,'attachment');
        $inputs['attachment']=$attachment;
        $ad=Ad::create($inputs);
        return $this->apiResponse(new MarketSingleResource($ad));

    }
    public function MarketAddComment($id,Request $request){
        $ads=Ad::findOrFail($id);
        $rules = [
            'comment' => 'required|string|',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $comment=new Comment();
        $comment->ads_id=$ads->id;
        $comment->user_id=auth()->id();
        $comment->comment=$request->comment;
        $comment->save();

        return $this->apiResponse(new CommentResource($comment));;

    }

    public function about()
    {
        return $this->apiResponse(getsetting('about'));
    }

    public function GetRandomAds(){
        $ads=Ad::take(3)->get();

        foreach ($ads as $ad){
            $ad['image']=getimg($ad['image']);
        }

        return $this->createdResponse($ads);
    }


    public function terms()
    {
        return $this->apiResponse(getsetting('terms'));
    }

    public function terms_user()
    {
        return $this->apiResponse(getsetting('terms_user'));
    }

    public function terms_provider()
    {
        return $this->apiResponse(getsetting('terms_provider'));
    }

  public function search(Request $request)
{
    $rules = [
        'sub_category_id' => 'nullable|exists:sub_categories,id',
        'country_id' => 'nullable|exists:countries,id',
        'city_id' => 'nullable|exists:cities,id',
        'keyword' => 'nullable|string|max:255', // Add this line for the keyword filter
    ];

    $validation = $this->apiValidation($request, $rules);
    if ($validation instanceof Response) {
        return $validation;
    }

    $query = User::query();
    $query->where('role', '=', 'provider')->where('is_active' , '1');

    $query->when(isset($request['sub_category_id']), function ($q) use ($request) {
        if ($request['sub_category_id'] != '') {
            $users = SubCategory::findOrFail($request['sub_category_id'])->UsersIds();
            $result = $q->whereIn('id', $users)->groupBy('id');
            return $result;
        }
    });

    $query->when(isset($request['city_id']), function ($q) use ($request) {
        if ($request['city_id'] != '') {
            $users = City::findOrFail($request['city_id'])->usersId();
            return $q->whereIn('id', $users);
        }
    });

    $query->when(isset($request['country_id']), function ($q) use ($request) {
        if ($request['country_id'] != '') {
            if (isset($request['city_id'])) {
                return $q;
            } else {
                $cities = Country::findOrFail($request['country_id'])->cities;
                $users = [];
                foreach ($cities as $city) {
                    if ($city->usersId()) {
                        foreach ($city->usersId() as $item) {
                            array_push($users, $item);
                        }
                    }
                }
                $users = array_unique($users);
                return $q->whereIn('id', $users);
            }
        }
    });

    // Add the keyword filter for provider's name
    $query->when(isset($request['keyword']), function ($q) use ($request) {
        if ($request['keyword'] != '') {
            return $q->where('name', 'like', '%' . $request['keyword'] . '%');
        }
    });

    $providers = $query->orderBy('is_top', 'DESC')->orderBy('id', 'Desc')->distinct()->paginate(15);

    return $this->apiResponse(new ProviderResource($providers));
}

//    public function search(Request $request)
//    {
//        $rules = [
//            'sub_category_id' => 'nullable|exists:sub_categories,id',
//            'country_id' => 'nullable|exists:countries,id',
//            'city_id' => 'nullable|exists:cities,id',
//            'keyword' => 'nullable|string|max:255', // Add this line for the keyword filter
//        ];
//
//        $validation = $this->apiValidation($request, $rules);
//        if ($validation instanceof Response) {
//            return $validation;
//        }
//
//        $query = User::query()->where('role', 'provider');
//
//        if ($request->filled('sub_category_id')) {
//            $subCategory = SubCategory::findOrFail($request->sub_category_id);
//            $query->whereHas('subCategories', function ($subQuery) use ($subCategory) {
//                $subQuery->where('sub_categories.id', $subCategory->id)->where('is_verified', 1);
//            });
//        }
//
//        if ($request->filled('city_id')) {
//            $city = City::findOrFail($request->city_id);
//            $query->where('users.city_id', $city->id);
//        }
//
//        if ($request->filled('country_id')) {
//            $country = Country::findOrFail($request->country_id);
//            if (!$request->filled('city_id')) {
//                $query->whereIn('users.city_id', $country->cities()->pluck('id'));
//            }
//        }
//
//        if ($request->filled('keyword')) {
//            $query->where('users.name', 'like', '%' . $request->keyword . '%');
//        }
//
//        $providers = $query->with(['subCategories', 'city.country'])->orderByDesc('is_top')->paginate(15);
//
//        return $this->apiResponse(new ProviderResource($providers));
//    }

    public  function  contact (Request $request){
        $rules = [
            'name' =>'required|string|max:191',
            'email'  =>'required|email|max:191',
            'message'  =>'required|string|max:791',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

            $contacts= new \App\Models\Contact_Us();
            $contacts->user_id=auth()->id();
            $contacts->email=$request->email;
            $contacts->name=$request->name;
            $contacts->message=$request->message;
            $contacts->save();

        return $this->createdResponse($contacts);

    }

    public function addToFavourites(Request $request){
        $rules = [
            'provider_id' =>'required|string|exists:users,id',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $favourites=  \App\Models\Favourites::where('user_id',auth()->id())->where('provider_id',$request->provider_id)->first();

        if($favourites){
            return $this->apiResponse(__('موجود فى المفضلة'));
        }
        $favourites= new \App\Models\Favourites();
        $favourites->provider_id=$request->provider_id;
        $favourites->user_id=auth()->id();
        $favourites->save();
        return $this->apiResponse(__('تم الاضافة إلى المفضلة'));
    }

    public function removeFromFavourites(Request $request){
        $rules = [
            'provider_id' =>'required|string|exists:users,id',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $favourites=  \App\Models\Favourites::where('user_id',auth()->id())->where('provider_id',$request->provider_id)->first();

        if($favourites){
            $favourites->delete();
            return $this->apiResponse(__('تم الحذف إلى المفضلة'));
        }
        return $this->apiResponse(__(' غير موجود بالمفضلة '));
    }

    public  function Favourites(){
        $favourites=  auth()->user()->favourites_user->transform(function ($q){return $q->providers;})->values();
//        return \response()->json($favourites);
        return $this->apiResponse(new ProviderResource($this->CollectionPaginate($favourites)));

    }


    public function  send(Request $request){
        $rules = [
            'message' =>'required|string',
            'order_id' =>'required',
            'receiver_id' =>'required|string',
        ];



        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $id=auth()->id();
        $request['sender_id']=$id;
        $request['user_id']=$request->receiver_id;

        $order = Order::find($request['order_id']);
        $receiver = User::find($request['receiver_id']);

        if($order && $receiver){
            $inbox = new Inbox();
            $inbox->order_id = $order->id;
            $inbox->user_id = $receiver->id;
            $inbox->sender_id = $id;
            $inbox->message = $request['message'];
            $inbox->created_at = Carbon::now();

            $inbox->save();
            if ($receiver->device_token){
                sendNotification($receiver->device_token,'رسالة جديدة',"رسالة جديدة علي الطلب $order->title");
            }
            $this->notifyByFirebase(
                'لديكم رسالة جديدة',
                'تطبيق باكيج',
                [$receiver->fcm_token_android],
                ['type'=>'message',
                    'data'=>['order_id'=>$request['order_id'] ,
                        'sender_id'=> $inbox->sender_id ,
                        'user_name'=>$inbox->sender->name ]]);


            $chats = Inbox::where('order_id',$order->id)->orderBy('id','ASC')->paginate(10);
            if($chats){
                $chats = new chatCollection($chats);
            }



            return \response()->json([
                'status'    => true,
                'msg'       => ' تم ارسال الرساله',
                'data'      => (new chatSingle($inbox))
            ],200);
        }else{
            return \response()->json([
                'status'    => false,
                'msg'       => 'تأكد من البيانات'
            ],200);
        }
    }

    public function showMessage($order_id){
        $auth = auth()->user();
        $order=Order::find($order_id);

        if($order){
            if($order->user_id == $auth->id || $order->provider_id == $auth->id){
                $chats = Inbox::where('order_id',$order->id)->orderBy('id','ASC')->paginate(10);
                if($chats){
                    $chats = new chatCollection($chats);

                    return $this->apiResponse($chats);
                }else{
                    return response()->json([
                        'status'    => true,
                        'msg'       => ' chat is empty'
                    ],200);
                }
            }else{
                return $this->apiResponse(null,'you are not authorized to get this chat details',403);
            }
        }

    }
    public function inbox(){
        $id=auth()->id();
        $inbox= Inbox::where('sender_id',$id)
            ->orWhere('user_id',$id)->latest()->with('User')
            ->with('Sender')->paginate(15);
        return $this->apiResponse( new InboxResource($inbox));
    }

    public function nationalities(){
        $nationalities=\App\Models\Nationality::all();
        $nationalities = NationalityResource::collection($nationalities);

        return $this->apiResponse($nationalities);
    }

    public function notifyByFirebase($title, $body, $tokens, $data = [] , $is_notification = true)
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

    public function checkEmail(Request $request){

        $user = User::where('email',$request->email)->first();

        if($user){
            return \response()->json([
                'status'    => false,
                'msg'       => 'Email already exist'
            ],200);
        }else{

            return \response()->json([
                'status'    => true,
                'msg'       => 'Email Available'
            ],200);
        }
    }

    public function checkPhone(Request $request){

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

        $user=User::where('phone',$phone)->first();

        if($user){
            return \response()->json([
                'status'    => false,
                'msg'       => 'Phone already exist'
            ],200);
        }else{

            return \response()->json([
                'status'    => true,
                'msg'       => 'Phone Available'
            ],200);
        }
    }



    public function sendReport(Request $request){

        $rules = [
            'image' =>'required|mimes:jpg,jpeg,gif,png',
            'type' =>'required',
            'message' =>'nullable|string',
        ];



        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $inputs = $request->all();
        $inputs['user_id']  = auth()->user()->id;
        $inputs['image']    = uploader($request,'image');
        $report = Report::create($inputs);

        if($report){

            return \response()->json([
                'success'   => true,
                'msg'       => 'تم إستلام إيصال الدفع طلبكم تحت المراجعة'
            ],200);

        }

        else {

            return \response()->json([
                'success'   => false,
                'msg'       => 'تأكد من البيانات المرسلة'
            ],400);

        }


    }


    public function getRandomBanner(){


        $banner = Banner::where('banner_type', 'app')
            ->where('end_date', '>=', Carbon::today())
            ->latest() // Assuming you want the latest banner based on creation date
            ->first();
        return $this->apiResponse($banner);


    }

    public function getRandomAdsBanner(){


        $banner = Banner::inRandomOrder()->where('banner_type','ads')->where('end_date','>=', Carbon::today())->first();


        return $this->apiResponse($banner);


    }

}
