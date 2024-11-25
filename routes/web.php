<?php


use App\Http\Controllers\Adminpanel\CatgoryController;   //admin panel 
use App\Http\Controllers\Adminpanel\ReferralLinkController;   //admin panel 
use App\Http\Controllers\Adminpanel\ReferralWebsiteController; //admin panel
use App\Http\Controllers\Adminpanel\UserController;   //admin panel 
use App\Http\Controllers\Adminpanel\UserRefereeController;   //admin panel 
use App\Http\Controllers\Auth\NewRegisterController;   //admin panel 

use App\Http\Controllers\Auth\VerificationController; // verification mail

use App\Http\Controllers\Frontend\FrontendController; //frontend panel

use App\Http\Controllers\message\MessagesController; // message

use App\Http\Controllers\Refereepanel\RefereeController; //referee panel


use App\Http\Controllers\Userpanel\ShareReferralLinkController; //user panel
use App\Http\Controllers\Userpanel\UserProfileController; //user panel

use App\Http\Controllers\Captcha\CaptchController;  //captch referesh

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

//public routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/website_details/{id}', 'terms_condition')->name('website_details');
    Route::get('/websites_list/{id}','all_websites_show')->name('all_websites');
    Route::get('/referral_code/{id}', 'referral_code')->name('referral_code');
    Route::get('/how_it_works', 'how_it_works')->name('how_it_works');
    Route::get('/faq', 'faq')->name('faq');
});

Route::get('/search-brands', [FrontendController::class, 'brand_search'])->name('search.brands');

Route::get('/user_profile/{id}', [UserProfileController::class, 'user_profile_public'])->name('user_profile');


//admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'IsAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('admin.layout');
    });
    Route::resource('/users', UserController::class)->names(['index' => 'users.index']);  // users route
    Route::resource('/category', CatgoryController::class)->names(['index' => 'category.index']); //category route
    Route::resource('/referral_links', ReferralLinkController::class)->names(['index' => 'referral_links.index']);  // referral link routes
    Route::resource('/referral_web_site',ReferralWebsiteController::class)->names(['index'=>'referral_web_site.index']);
    Route::resource('/referee', UserRefereeController::class)->names(['index' => 'referee.index']);  // add the referee with usertype referee
});

Route::post('/click_activity_data', [FrontendController::class, 'store_click_activity_data'])->name('click_activity_data');

Auth::routes();


Route::post('storeregisterdata', [NewRegisterController::class, 'store'])->name('storeregisterdata');
//verification mail route
Route::get('/verify-email', [VerificationController::class, 'showVerifyForm'])->name('verification.notice');
Route::post('/verify-email-code', [VerificationController::class, 'verifyemailcode'])->name('verify-email-code');
Route::post('/resend-verification-email', [VerificationController::class, 'resend_verification_email'])->name('resend-verification-email');

//user routes protected
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'IsUser']], function () {
    Route::get('/profile_dashboard', [UserProfileController::class, 'profile_dashboard'])->name('profile_dashboard');
    Route::get('/click_dashboard', [FrontendController::class, 'click_dashboard'])->name('click_dashboard');
    Route::get('/referral_pages_dashboard', [FrontendController::class, 'referral_pages_dashboard'])->name('referral_pages_dashboard');
    Route::get('/user_message/{id}', [FrontendController::class, 'user_message'])->name('user_message');
    Route::get('/edit_profile/{id}', [UserProfileController::class, 'edit_profile_get_details'])->name('edit_profile');
    Route::post('/update_profile/{id}', [UserProfileController::class, 'update_profile'])->name('update_profile');
    
    // Route::get('/dashboard', function () {
    //     return view('frontend.pages.dashboard');
    // });
});
Route::group(['middleware'=>['auth','CheckUserType:user,referee']],function(){
    Route::get('/messages', [MessagesController::class, 'message_home'])->name('message_home');
    Route::post('/save_message', [MessagesController::class, 'save_message'])->name('save_message');
    Route::get('/get_msg_data/{id}', [MessagesController::class, 'get_msg_data'])->name('get_msg_data');
});

//add refferal link
Route::group(['middleware' => ['auth', 'IsUser']], function () {
    Route::get('/get-referral-link-data/{id}', [ShareReferralLinkController::class, 'getReferralLinkData']);
    Route::get('/edit-referral-link/{id}', [ShareReferralLinkController::class, 'editReferralLink'])->name('edit.referral.link');
    Route::post('/update-referral-link', [ShareReferralLinkController::class, 'updateReferralLink'])->name('update.referral.link');
    Route::get('/share-referral', [ShareReferralLinkController::class, 'shareReferralLink'])->name('share.referral.link');
    Route::post('/share-referral', [ShareReferralLinkController::class, 'saveReferralLink'])->name('save.referral.link');
});

//Referee routes

Route::group(['prefix'=>'referee','middleware'=>['auth','IsReferee']],function (){
    Route::get('/referee_dashboard',[RefereeController::class,'referee_dashboard'])->name('referee_dashboard');
    Route::get('/edit_profile/{id}',[RefereeController::class,'edit_profile'])->name('referee_edit_profile');
    Route::post('/update_profile/{id}',[RefereeController::class,'update_profile_referee'])->name('referee_update_profile');
    Route::post('/save_ratings',[RefereeController::class,'save_ratings'])->name('save_ratings');
});
//captcha referesh route
Route::get('refreshcaptcha', [CaptchController::class, 'refreshCaptcha']);

