<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin/login','\App\Http\Controllers\Auth\LoginController@adminLogin')->name('adminLogin');
Route::get('/', '\App\Http\Controllers\FrontController@index')->name('home');

// Route::middleware('auth.redirect')->group(function () {

Route::group(['prefix' => 'paypal','as'=>'paypal.'], function(){
    Route::get('pay', '\App\Http\Controllers\PaypalController@add_to_wallet')->name('pay');
    Route::get('success','\App\Http\Controllers\PaypalController@onProcessingCourseSuccess')->name('success');
    Route::get('success2','\App\Http\Controllers\PaypalController@onProcessingCourseSuccess2')->name('success');
    Route::get('success3','\App\Http\Controllers\PaypalController@onProcessingCourseSuccess3')->name('success');
    Route::get('canceled','\App\Http\Controllers\PaypalController@onProcessingCourseCanceled')->name('canceled');
});

////////////////////////////////// design events routes ///////////////////////////

Route::get('/design/events','\App\Http\Controllers\FrontController@designEvents')->name('user.design_events');
Route::get('/user/design/events/success',function (){
    //نرجو زيارة صفحة الدفع
    alert()->success('تم تنزيل البطاقة ')->autoclose(6000);
    return redirect()->back();
});
Route::post('/design/events/sub_categories','\App\Http\Controllers\FrontController@designEventsSubCategories')->name('user.design_events_sub_categories');
Route::get('/design/events/single_event/{id}','\App\Http\Controllers\FrontController@singleEevnt')->name('user.single_event');

////////////////////////////////// design events routes ///////////////////////////


Route::get('pdf','DynamicPDFController@pdf')->name('printpdf');
Route::get('/task','\App\Http\Controllers\FrontController@task');
Route::get('/active/user','\App\Http\Controllers\FrontController@active')->name('active');
Route::post('/active/user','\App\Http\Controllers\FrontController@mobile_activation')->name('mobile_activation');
Route::post('/checkemail}','\App\Http\Controllers\FrontController@checkEmail')->name('checkEmail');
Route::post('/checkmobile}','\App\Http\Controllers\FrontController@checkMobile')->name('checkMobile');
// Route::get('/', '\App\Http\Controllers\Auth\LoginController@adminLogin')->name('home');

Route::get('/department', '\App\Http\Controllers\FrontController@categories')->name('department');
Route::get('/sub-category/{category_id}', '\App\Http\Controllers\FrontController@subCategory')->name('subCategory');
Route::get('/ads/{id}', '\App\Http\Controllers\FrontController@showads')->name('showads');
Route::get('/ads-category', '\App\Http\Controllers\FrontController@adsCategory')->name('AdsCategory');
Route::get('/contact', '\App\Http\Controllers\FrontController@contact')->name('contact');
//Route::get('/sign-in', '\App\Http\Controllers\FrontController@signIn')->name('signIn');
Route::get('/map', '\App\Http\Controllers\FrontController@map')->name('map');
Route::get('/terms', '\App\Http\Controllers\FrontController@terms')->name('terms');
Route::get('/requests', '\App\Http\Controllers\FrontController@requests')->name('requests');
Route::get('/offers', '\App\Http\Controllers\FrontController@offers')->name('offers');
Route::get('/profile/{id}', '\App\Http\Controllers\FrontController@profile')->name('profile');
Route::get('/service/sub_category/{sub_category}', '\App\Http\Controllers\FrontController@service')->name('service');
Route::get('/service/ads_category/{sub_category}', '\App\Http\Controllers\FrontController@adProvider')->name('adservice');
Route::get('/service/single_service/{service_id}', '\App\Http\Controllers\FrontController@singleService')->name('single_service');
Route::get('/logout', '\App\Http\Controllers\FrontController@logout');
Route::get('/provider-register', '\App\Http\Controllers\FrontController@providerRegister')->name('providerRegister');
Route::get('/client-register', '\App\Http\Controllers\FrontController@clientRegister')->name('clientRegister');

Route::get('/users', '\App\Http\Controllers\FrontController@users')->name('users');
Route::get('/private-messages/{user}', '\App\Http\Controllers\FrontController@privateMessages')->name('privateMessages');
Route::post('/private-messages/{user}', '\App\Http\Controllers\FrontController@sendPrivateMessage')->name('privateMessages.store');
Route::post('/addContact', '\App\Http\Controllers\FrontController@addContact')->name('addContact');
Route::get('/search-ads/','\App\Http\Controllers\FrontController@searchAds')->name('searchAds');
Route::get('/search-providers/','\App\Http\Controllers\FrontController@searchProvider')->name('searchProvider');
Route::get('/getCleaners/','\App\Http\Controllers\FrontController@getCleaners')->name('getCleaners');
Route::get('/TEST-SMS/','\App\Http\Controllers\FrontController@TESTSMS');

Route::get('/message/{id}','\App\Http\Controllers\FrontController@inboxMessage')->name('message');
Route::post('/message','\App\Http\Controllers\FrontController@SendMessage')->name('send_message');

Route::get('/verify','\App\Http\Controllers\FrontController@verify')->name('verify');
Route::post('/password/send/active','\App\Http\Controllers\FrontController@sendEmail')->name('sendactivemail');
Route::get('update-password','\App\Http\Controllers\FrontController@getUpdatePassword')->name('update-password');
Route::post('update-password','\App\Http\Controllers\FrontController@updatePassword')->name('update-password');
Route::get('/resend/email','\App\Http\Controllers\FrontController@ActiveEmail')->name('resend.active');
Route::post('/resend/email','\App\Http\Controllers\FrontController@sendActiveEmail')->name('resend.active');
Route::get('/events/sub_categories/{id}','Admin\RegionController@subCat');
Route::group(array('prefix' => 'user','as'=>'user.','middleware'=>'auth'), function() {

    Route::post('/save-token','\App\Http\Controllers\FrontController@saveToken')->name('save-token');
    Route::post('/send-notification', '\App\Http\Controllers\FrontController@sendNotification')->name('send.notification');
    Route::post('/account_upgrade', '\App\Http\Controllers\PaypalController@add_to_wallet')->name('account_upgrade');
    Route::post('/account_star', '\App\Http\Controllers\PaypalController@add_to_star')->name('account_star');
    Route::get('/my-account','\App\Http\Controllers\FrontController@myAccount')->name('myAccount');
    Route::get('/projects','\App\Http\Controllers\FrontController@myProjects')->name('myProjects');
    Route::get('/edit-project/{id}','\App\Http\Controllers\FrontController@editProject')->name('editProject');
    Route::get('/add-project','\App\Http\Controllers\FrontController@addProject')->name('addProject');
    Route::post('/save-project','\App\Http\Controllers\FrontController@saveNewProject')->name('saveNewProject');
    Route::post('/edit-project/{id}','\App\Http\Controllers\FrontController@saveProject')->name('saveProject');
    Route::get('/remove-project/{id}','\App\Http\Controllers\FrontController@removeProject')->name('removeProject');
    Route::get('/my-account-edit','\App\Http\Controllers\FrontController@editMyAccount')->name('editMyAccount');
    //Route::post('/edit_client','\App\Http\Controllers\FrontController@saveClient')->name('edit_client');
    Route::post('/client','\App\Http\Controllers\FrontController@saveClient')->name('client');
    Route::post('/change-password','\App\Http\Controllers\FrontController@changePassword')->name('changePassword');
    Route::get('/','\App\Http\Controllers\FrontController@userIndex')->name('userIndex');
    Route::get('/orders','\App\Http\Controllers\FrontController@orders')->name('userNew');
    Route::get('/notifications','\App\Http\Controllers\FrontController@notifications')->name('notifications');
    Route::get('/delete-notification/{id}','\App\Http\Controllers\FrontController@deleteSingleNotification')->name('delete_notification');
    Route::get('/delete_notifications','\App\Http\Controllers\FrontController@delete_notifications')->name('delete_notifications');
    Route::get('/password','\App\Http\Controllers\FrontController@password')->name('password');
    Route::get('/invite-friends','\App\Http\Controllers\FrontController@inviteFriends')->name('invite-friends');
    Route::get('/msg-list/','\App\Http\Controllers\FrontController@chat')->name('msg-list');
    Route::get('/msg-list/{provider_id}','\App\Http\Controllers\FrontController@singlechat')->name('msg-list-single');
    Route::get('/post-requirement/{provider_id}','\App\Http\Controllers\FrontController@Sendorder')->name('post-requirement');
    Route::post('/post-requirement/{provider_id}','\App\Http\Controllers\FrontController@postOrder')->name('post-order');
    Route::get('/post-ads/','\App\Http\Controllers\FrontController@createAds')->name('createAds');
    Route::post('/post-ads/','\App\Http\Controllers\FrontController@addAds')->name('addAds');

    Route::get('/post-offer/','\App\Http\Controllers\FrontController@createOffer')->name('createOffer');
    Route::post('/post-offer/','\App\Http\Controllers\FrontController@addOffer')->name('addOffer');
    Route::post('/post-comment/{id}','\App\Http\Controllers\FrontController@addComment')->name('addComment');

    Route::get('/order/{id}','\App\Http\Controllers\FrontController@showOrder')->name('showOrder');
    Route::post('/order/update_price','\App\Http\Controllers\FrontController@updateOrderPrice')->name('updateOrderPrice');
    Route::get('/order/{id}/accept','\App\Http\Controllers\FrontController@acceptOrder')->name('acceptOrder');
    Route::get('/order/{id}/cancel','\App\Http\Controllers\FrontController@cancelOrder')->name('cancelOrder');
    Route::get('/order/{id}/finish','\App\Http\Controllers\FrontController@finishOrder')->name('finishOrder');

    // delete sub categories

    Route::post('/delete/sub_categories/provider','\App\Http\Controllers\FrontController@providerDeleteSubCategories')->name('delete_sub_category');
    Route::post('/delete/ads_category/provider','\App\Http\Controllers\FrontController@providerDeleteAdsCategories')->name('delete_ads_category');

    /*Route::get('/market-request','\App\Http\Controllers\FrontController@marketRequest')->name('market-request');
    Route::get('/market-offer','\App\Http\Controllers\FrontController@marketOffer')->name('market-offer');
    Route::get('/market-offer/search','\App\Http\Controllers\FrontController@marketOfferSearch')->name('market-offer-search');
    Route::get('/market-request/search','\App\Http\Controllers\FrontController@marketRequestSearch')->name('market-request-search');
    Route::get('/market/{id}','\App\Http\Controllers\FrontController@marketShow')->name('marketShow');
*/
    Route::get('/market-request',function (){
        return view('user.design');
    })->name('market-request');
    Route::post('rate/','\App\Http\Controllers\FrontController@rateProvider')->name('rateProvider');


//    Route::get('/msg-list', function () {
//        return view('user.msg-list');
//    })->name('msg-list');

    Route::get('/post-requirement/{provider_id?}', function () {
        return view('user.post-requirement');
    })->name('post-requirement');

    Route::get('pay-type','\App\Http\Controllers\FrontController@payType')->name('pay_type');
    Route::get('pay-star','\App\Http\Controllers\FrontController@payStar')->name('pay_star');
    Route::get('pay-design','\App\Http\Controllers\FrontController@payDesign')->name('pay_design');
    Route::get('pay-commission','\App\Http\Controllers\FrontController@payCommision')->name('pay_commission');

    Route::get('/pay', function () {
        return view('user.pay-type');
    })->name('pay');


    Route::get('/send/report','\App\Http\Controllers\FrontController@sendReport')->name('send_report');
    Route::post('/send/report','\App\Http\Controllers\FrontController@saveSendReport')->name('save_send_report');

    Route::get('/card','\App\Http\Controllers\FrontController@userCard')->name('card');


   ////////////////////////////////////////
    Route::get('/design', function () {
        return view('user.design');
    })->name('design');



});



//    Route::get('/providers', function () {
//        return view('user.provider');
//    });

// });


Auth::routes();
//Route::get('/home', 'App\Http\Controllers\Admin\IndexController@index')->name('home');

//admin
Route::resource('/regions', 'App\Http\Controllers\Admin\RegionController');
Route::get('/regions2/{id}','App\Http\Controllers\Admin\RegionController@cities');
    Route::get('/city/{id}','App\Http\Controllers\Admin\IndexController@getCity');
    Route::get('/region/{id}','App\Http\Controllers\Admin\IndexController@getRegion');
    Route::get('/sub_category/{id}','App\Http\Controllers\Admin\IndexController@getSubCategory');
    Route::get('/services/{id}','App\Http\Controllers\Admin\ServicesController@show');
    Route::get('/client/{id}', 'App\Http\Controllers\@show');
    Route::get('/subcategories/{id}', 'App\Http\Controllers\Admin\SubCategoryController@show');

Route::group(array('prefix' => 'dashboard','as'=>'admin.', 'middleware' => 'admin'), function() {

    Route::resource('sliders', 'App\Http\Controllers\Admin\SliderController');
    Route::resource('banners', 'App\Http\Controllers\Admin\BannerController');
    Route::resource('reports', 'App\Http\Controllers\Admin\ReportController');

    Route::get('report/active_star/{id}','App\Http\Controllers\Admin\ReportController@activeStar')->name('active_star');
    Route::get('user/active_star/{id}','App\Http\Controllers\Admin\ClientController@activeStar')
        ->name('user.active_star');
    Route::get('user/block_star/{id}','App\Http\Controllers\Admin\ClientController@blockStar')
        ->name('user.block_star');

    Route::get('report/active_commission/{id}','App\Http\Controllers\Admin\ReportController@activeCommission')->name('active_commission');
    Route::get('/', 'App\Http\Controllers\Admin\IndexController@index');
    //GEO
    Route::resource('/country', 'App\Http\Controllers\Admin\CountryController');

    Route::resource('/cities', 'App\Http\Controllers\Admin\CityController');

    Route::resource('/regions', 'App\Http\Controllers\Admin\RegionController');

    //Route::get('/events/sub_categories/{id}', 'Admin\RegionController@subCat');

    // ajax request city & region & subcategory
    Route::get('/city/{id}','App\Http\Controllers\Admin\IndexController@getCity');
    Route::get('/region/{id}','App\Http\Controllers\Admin\IndexController@getRegion');
    Route::get('/sub_category/{id}','App\Http\Controllers\Admin\IndexController@getSubCategory');

    Route::get('/services/{id}','App\Http\Controllers\Admin\IndexController@getServices');

    // chats
    Route::get('/chats','App\Http\Controllers\Admin\ChatController@index')->name('chats.index');

    Route::get('active/user/{id}','App\Http\Controllers\Admin\ProviderController@activeUser')->name('active.user');
    //Categories
    Route::resource('/categories', 'App\Http\Controllers\Admin\CategoryController');
    Route::resource('/adscategories', 'App\Http\Controllers\Admin\AdsCategoryController');
    Route::resource('/subcategories', 'App\Http\Controllers\Admin\SubCategoryController');
    Route::resource('/service', 'App\Http\Controllers\Admin\ServicesController');

    // design events
    Route::resource('/events-categories', 'App\Http\Controllers\Admin\CatEventController');
    Route::resource('/events-sub-categories', 'App\Http\Controllers\Admin\SubCatEventController');
    Route::resource('/events', 'App\Http\Controllers\Admin\EventsController');



    //users
    Route::resource('/admin', 'App\Http\Controllers\Admin\AdminController');
    Route::resource('/client', 'App\Http\Controllers\Admin\ClientController');
    Route::get('/client/show/{id}', 'App\Http\Controllers\Admin\ClientController@showClient')->name('show_client');
    Route::post('/client/change-permission', 'App\Http\Controllers\Admin\ClientController@changePermission')->name('changePermission');
    Route::get('/client/block/{id}','App\Http\Controllers\Admin\ClientController@block')->name('client.block');
    Route::get('/active_client/{id}','App\Http\Controllers\Admin\ClientController@active')->name('client.active');
    Route::resource('/provider', 'App\Http\Controllers\Admin\ProviderController');

    Route::post('providers/updateall', 'App\Http\Controllers\Admin\ProviderController@updateAll')->name('provider.updateAll');

    Route::get('/delete/sub_category/provider/{id}/{provider_id}',
        'App\Http\Controllers\Admin\ProviderController@deleteSubCategory')
        ->name('delete_sub_category');


    Route::post('/add/sub_categories/to/provider','App\Http\Controllers\Admin\ProviderController@addSubCategoriesToProvider')->name('addSubCategoriesToProvider');

    Route::get('/delete/ads_category/provider/{provider_id}',
        'App\Http\Controllers\Admin\ProviderController@deleteAdsCategory')
        ->name('delete_ads_category');

    Route::get('/provider/block/{id}','App\Http\Controllers\Admin\ProviderController@block')->name('provider.block');
    Route::get('/provider/delete/{id}','App\Http\Controllers\Admin\ProviderController@destroy')->name('provider.destroy');
    Route::get('/provider/top/{id}','App\Http\Controllers\Admin\ProviderController@top')->name('provider.top');
    Route::get('/provider/remove_top/{id}','App\Http\Controllers\Admin\ProviderController@notTop')->name('provider.removeT');
    Route::get('/active_provider/{id}','Admin\App\Http\Controllers\ProviderController@active')->name('provider.active');
    Route::get('/view_provider/{id}','App\Http\Controllers\Admin\ProviderController@view')->name('provider.view');
    Route::get('/delete_selected_subcategories/','App\Http\Controllers\Admin\ProviderController@delete_selected_subcategories')->name('delete_selected_subcategories');

    Route::resource('/contacts', 'App\Http\Controllers\Admin\ContactController');
    Route::resource('/order', 'App\Http\Controllers\Admin\OrderController');
    Route::resource('/ad', 'App\Http\Controllers\Admin\AdsController');
    Route::resource('/qualification', 'App\Http\Controllers\Admin\QualificationController');
         Route::get('ajax_country/{country_id}', 'App\Http\Controllers\@ajaxcountry');
//    Route::get('/send', 'IndexController@sendNotification');
    Route::resource('/notifications','App\Http\Controllers\Admin\NotificationsController');

    Route::resource('/sends','App\Http\Controllers\Admin\SendsController');

    Route::get('providers/report','App\Http\Controllers\Admin\providersReportController@index')->name('providers.report.index');
    Route::post('providers/report','App\Http\Controllers\Admin\providersReportController@filter')
        ->name('providers.report.filter');
    Route::get('orders/report','App\Http\Controllers\Admin\orderReportController@index')->name('orders.report.index');
    Route::post('orders/report','App\Http\Controllers\Admin\orderReportController@filter')
        ->name('orders.report.filter');
    Route::get('/{slug}','App\Http\Controllers\Admin\SettingController@index')->name('setting.index');
    Route::post('setting','App\Http\Controllers\Admin\SettingController@StoreSetting')->name('setting.store');

});
    Route::get('/selectcategoryTypes','App\Http\Controllers\Admin\SendsController@selectcategoryTypes')->name('selectcategoryTypes');

Route::get('/dashboard/Cart_single', 'App\Http\Controllers\Admin\CartController@test');
Route::get('/order', 'App\Http\Controllers\Admin\OrderController@show');
