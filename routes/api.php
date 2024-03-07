<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'paypal','as'=>'paypal.'], function(){
    Route::get('pay', 'App\Http\Controllers\Api\PaypalController@add_to_wallet')->name('pay');
    Route::get('success','App\Http\Controllers\Api\PaypalController@onProcessingCourseSuccess')->name('success');
    Route::get('success2','App\Http\Controllers\Api\PaypalController@onProcessingCourseSuccess2')->name('success');
    Route::get('canceled','App\Http\Controllers\Api\PaypalController@onProcessingCourseCanceled')->name('canceled');
});


Route::group(['middleware'=>'localization'],function () {

    Route::get('nationalities','App\Http\Controllers\Api\HomeController@nationalities');
    Route::get('banners','App\Http\Controllers\Api\HomeController@getRandomBanner');
    Route::get('ads-banners','App\Http\Controllers\Api\HomeController@getRandomAdsBanner');
    Route::get('terms_user','App\Http\Controllers\Api\HomeController@terms_user');
    Route::get('terms_provider','App\Http\Controllers\Api\HomeController@terms_provider');
    Route::get('categories','App\Http\Controllers\Api\HomeController@GetAllCategory');
    Route::get('categories-mobile','App\Http\Controllers\Api\HomeController@GetAllCategoryMobile');
    Route::get('order-titles', 'App\Http\Controllers\Api\HomeController@orderTitles');
    Route::post('check_email','App\Http\Controllers\Api\HomeController@checkEmail');
    Route::post('check_phone','App\Http\Controllers\Api\HomeController@checkPhone');

    Route::get('projects/provider-projects/{id}',
        'App\Http\Controllers\Api\OrderController@GetProjectsForProvider');


    Route::get('special_order/{id}','App\Http\Controllers\Api\OrderController@OrderProviderUserDetails');

    Route::get('sub-categories','App\Http\Controllers\Api\HomeController@GetSubCategories');
    Route::get('sub_categories/{category_id}','App\Http\Controllers\Api\HomeController@GetSubCategoryByCategory');
    Route::get('providers/{sub_category_id}','App\Http\Controllers\Api\HomeController@GetProviderBySubCategory');
    Route::get('providers-registrations','App\Http\Controllers\Api\HomeController@GetProviderByCityRegistration');
    Route::get('ads-providers-registrations','App\Http\Controllers\Api\HomeController@GetAdsProviderByCityRegistration');
    Route::get('qualifications','App\Http\Controllers\Api\HomeController@GetAllQualification');

    Route::group(['prefix'=>'locations'],function (){
        Route::get('countries','App\Http\Controllers\Api\LocationController@GetAllContries');
        Route::get('cities/{country_id}','App\Http\Controllers\Api\LocationController@GetCitiesByCountry');
        Route::get('regions/{city_id}','App\Http\Controllers\Api\LocationController@GetRegionsByCity');
    });

    Route::group(['prefix'=>'market'],function (){
        Route::get('requests','App\Http\Controllers\Api\HomeController@marketRequest');
        Route::get('offers','App\Http\Controllers\Api\HomeController@marketOffers');
        Route::get('single/{id}','App\Http\Controllers\Api\HomeController@marketSingle');
        Route::Post('add/request','App\Http\Controllers\Api\HomeController@MarketAddRequest')->middleware('jwt.auth');;
        Route::Post('add/offer','App\Http\Controllers\Api\HomeController@MarketAddOffer')->middleware('jwt.auth');;
        Route::Post('add/comment/{id}','App\Http\Controllers\Api\HomeController@MarketAddComment')->middleware('jwt.auth');;

    });

    Route::group(['prefix'=>'auth'],function () {
        Route::post('register/{user_type?}', 'App\Http\Controllers\Api\AuthController@register');
        Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
        Route::post('activate', 'App\Http\Controllers\Api\AuthController@mobile_activation');
        Route::post('resend_code', 'App\Http\Controllers\Api\AuthController@resend_code');
        Route::post('reset', 'App\Http\Controllers\Api\AuthController@reset_password');
        Route::post('forget', 'App\Http\Controllers\Api\AuthController@forget_password');
        Route::post('check', 'App\Http\Controllers\Api\AuthController@check_code');
    });

    Route::group(['middleware' => ['jwt.auth']], function () {

        // sending the type of pay


        Route::get('getNotificationCount','App\Http\Controllers\Api\OrderController@getNotificationCount');

        Route::group(['prefix' => 'user'], function () {
            Route::post('/upgrade/paypal', 'App\Http\Controllers\Api\PaypalController@add_to_wallet');
            //Route::post('/pay', 'App\Http\Controllers\Api\PaypalController@onProcessingCourseSuccess');

            Route::get('get_fcm_token','App\Http\Controllers\Api\AuthController@getFcmToken');
            Route::get('delete-my-account/{id}','App\Http\Controllers\Api\AuthController@DeleteProvider');
            Route::post('update_fcm_token','App\Http\Controllers\Api\AuthController@updateFcmToken');
            Route::post('send_report','App\Http\Controllers\Api\HomeController@sendReport');

            Route::get('logout','App\Http\Controllers\Api\AuthController@Logout');
            Route::group(['prefix' => 'update'], function () {
                Route::post('profile', 'App\Http\Controllers\Api\AuthController@UpdateProfile');
                Route::post('location', 'App\Http\Controllers\Api\AuthController@UpdateLocation');
            });
        });

         Route::group(['prefix' => 'provider'], function () {
             Route::get('showNotification/{id}', 'App\Http\Controllers\Api\OrderController@showNotification');
             Route::group(['prefix' => 'projects'], function () {
                 Route::post('new', 'App\Http\Controllers\Api\OrderController@Addproject');
                 Route::post('edit/{id}', 'App\Http\Controllers\Api\OrderController@EditProject');
                 Route::get('get/{id}', 'App\Http\Controllers\Api\OrderController@Getproject');
                 Route::delete('delete/{id}', 'App\Http\Controllers\Api\OrderController@DeleteProject');
                 Route::get('provider-projects', 'App\Http\Controllers\Api\OrderController@GetProviderprojects');

             });
             Route::group(['prefix' => 'ordered'], function () {
                Route::get('status/{id}', 'App\Http\Controllers\Api\OrderController@orderStatus');
                Route::get('accepted', 'App\Http\Controllers\Api\OrderController@GetAllProviderAcceptedOrdered');
                Route::get('canceled', 'App\Http\Controllers\Api\OrderController@GetAllProviderCanceledOrdered');
                Route::get('pending', 'App\Http\Controllers\Api\OrderController@GetAllProviderPendingOrdered');
                Route::get('all', 'App\Http\Controllers\Api\OrderController@GetAllProviderAllOrdered');
                Route::get('finished', 'App\Http\Controllers\Api\OrderController@GetAllProviderFinishedOrdered');
                Route::get('notifications', 'App\Http\Controllers\Api\OrderController@getNotification');

                //actions
                Route::post('cancel', 'App\Http\Controllers\Api\OrderController@cancelOrder');
                Route::post('accept', 'App\Http\Controllers\Api\OrderController@AcceptOrder');
                Route::post('finish', 'App\Http\Controllers\Api\OrderController@finishOrder');
                Route::post('update_price', 'App\Http\Controllers\Api\OrderController@updatePrice');

            });
         });

         Route::group(['prefix' => 'client'], function () {

             Route::get('showNotification/{id}', 'App\Http\Controllers\Api\OrderController@showNotification');
             Route::post('addToFavourites', 'App\Http\Controllers\Api\HomeController@addToFavourites');
             Route::post('removeFromFavourites', 'App\Http\Controllers\Api\HomeController@removeFromFavourites');
             Route::post('Favourites', 'App\Http\Controllers\Api\HomeController@Favourites');

             Route::group(['prefix' => 'ordered'], function () {
                Route::get('accepted', 'App\Http\Controllers\Api\OrderController@GetAllUserAcceptedOrdered');
                Route::get('canceled', 'App\Http\Controllers\Api\OrderController@GetAllUserCanceledOrdered');
                Route::get('pending', 'App\Http\Controllers\Api\OrderController@GetAllUserPendingOrdered');
                Route::get('all', 'App\Http\Controllers\Api\OrderController@GetAllUserAllOrdered');
                Route::get('finished', 'App\Http\Controllers\Api\OrderController@GetAllUserFinishedOrdered');
                Route::get('notifications', 'App\Http\Controllers\Api\OrderController@getNotification');
                //actions
                Route::post('send', 'App\Http\Controllers\Api\OrderController@SendOrder');
                Route::post('cancel', 'App\Http\Controllers\Api\OrderController@cancelOrder');
                Route::post('rate', 'App\Http\Controllers\Api\OrderController@rateOrder');
            });
         });

         Route::get('service/providers/{service_id}','App\Http\Controllers\Api\HomeController@GetServicesProviders');
         Route::get('user/recommendations/{user_id}','App\Http\Controllers\Api\AuthController@GetProfile');
         Route::get('user/provider/{user_id}','App\Http\Controllers\Api\AuthController@GetProvider');
         Route::resource('chat','App\Http\Controllers\Api\chatController');
         //Route::get('inbox','App\Http\Controllers\Api\HomeController@inbox');
         Route::get('inbox/{order_id}','App\Http\Controllers\Api\HomeController@showMessage');
         Route::post('send/message','App\Http\Controllers\Api\HomeController@send');

    });


    Route::post('search','App\Http\Controllers\Api\HomeController@search');
    Route::get('ads','App\Http\Controllers\Api\HomeController@GetRandomAds');
    Route::get('get-ads-categories','App\Http\Controllers\Api\HomeController@getAdsCategories');
    Route::get('service/ads/provider','App\Http\Controllers\Api\HomeController@GetProviderByAdsCategory');
    Route::get('about','App\Http\Controllers\Api\HomeController@about');
    Route::get('terms','App\Http\Controllers\Api\HomeController@terms');
    Route::get('sliders','App\Http\Controllers\Api\HomeController@getSlideShow');
    Route::post('contact','App\Http\Controllers\Api\HomeController@contact');



});
