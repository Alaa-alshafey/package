<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Http\Resources\QualificationResource;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    protected $appends=['online'];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 'email','nationality',
        'is_special','cv','address','discount','emp_no','creation_year','commerical_no','map','delivery','charitable',
        'gender','general_specification','nano_specification','experience_years', 'phone', 'identity', 'password','bio',
        'image', 'job', 'qualifications', 'certifications','lng','lat', 'role', 'is_admin', 'fcm_token_android',
        'fcm_token_ios', 'confirmation_code', 'verification_code', 'is_verified', 'remember_token','city_id', 'code',
        'provider_type','provider_company_type','service_id', 'is_active','service_price',
        'bio','ads_category','is_top','commission','created_at','updated_at','account_maroof','account_freelancer',
        'device_token','registration'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function qualifications()
    {
        return $this->hasMany('App\Models\Qualification','qualifications');
    }

    public function services(){
        return $this->belongsTo(Service::class,'service_id','id');
    }


    public function orders2()
    {
        return $this->hasMany('App\Models\Order','orders');
    }

    public function userOrders()
    {
        return $this->hasMany('App\Models\Order','user_id');
    }

    public function providerOrders()
    {
        return $this->hasMany('App\Models\Order','provider_id');
    }


    public function SubCategories()
    {
        return $this->belongsToMany('App\Models\SubCategory','user_sub_categories');
    }

    public function userSubCategories()
    {
        return $this->hasMany(UserSubCategory::class,'user_id');
    }


    public function getUserQualifications()
    {
        $qualifications = json_decode($this->qualifications);

        if(is_array($qualifications))
        {
            $qualifications = Qualification::whereIn('id',$qualifications)->get();
            $qualifications = QualificationResource::collection($qualifications);
            return $qualifications;
           }else{
            return $qualifications;
        }
    }
    public function getUserSubCategories()
    {


            $qualifications = $this->SubCategories();

            return $qualifications;

    }

    public function favourites_user()
    {
        return $this->hasMany(Favourites::class,'user_id');
    }

    public function favourites_providrers(){
        $providers=$this->favourites_user();
        $prov=User::where('id',';')->paginate(15);
        foreach ($providers as $provider){
            $providerget=User::where('id',$provider)->first();
            if($providerget){
                $prov->push($providerget);
            }
        }
        return $prov;
    }

    public function Region()
    {
        return $this->belongsTo('App\Models\Region','region_id');
    }

    public function City()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order','provider_id')->where('status','finished')->get(['rate','comment']);
    }
    public function orders3(){
        $orders = $this->hasMany('App\Models\Order','provider_id');
        foreach ($orders->get() as $order){
            if($order->rate==null){
                $order->rate1=0;
            }else{
                $order->rate1=$order->rate;
            }
        }

        return $orders;
    }

    public function comment(){
        return $this->hasMany('App\Models\Order','provider_id')->where('status','finished')->where('comment','!=',null)->get(['rate','comment','user_id']);
    }


    public function rate(){
        $orders= $this->orders();
        $rate=0;
        $total = $orders->count();
        foreach ($orders as $order)
        {
            if($order->rate!=null){
                $rate=$rate+$order->rate;
            }
        }
        if($total>0)
        {
            $newrate=$rate/$total;
            $newrate=floatval( $newrate);
            $newrate=round($newrate,2) ;
            return  (string)$newrate ;}
        else
            return 0;
    }

    public function messages()
    {
        return $this->hasMany(Inbox::class);
    }

    public function toMeMessages()
    {
        return $this->hasMany(Inbox::class,'sender_id');
    }

    public function projects()
    {
        return $this->hasMany(ProviderProject::class);
    }

    public  function getOnlineAttribute(){
        return $this->isOnline();
    }


    public function userMessages(){
        return $this->hasMany(Message::class,'user_id','id');
    }

    public function providerMessages(){
        return $this->hasMany(Message::class,'provider_id','id');
    }

    public function adsCategory(){
        return $this->belongsTo(AdsCategory::class,'ads_category','id');
    }


    public function getCreatedAttribute()
    {
        return "{$this->created_at}";
    }


    public function providerCount(){

        return $this->hasMany(ProviderViewer::class);

    }

    public function userNotifications(){

        return $this->hasMany(Notification::class,'user_id');

    }


}
