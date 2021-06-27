<?php

use App\Http\Controllers\Admin\ComplaintsOfCategories;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AllCategories;
use App\Http\Controllers\User\AllStoresControll;
use App\Http\Controllers\User\ContactControll;
use App\Http\Controllers\User\DescriptionCategory;
use App\Http\Controllers\User\LoginRedirectControll;
use App\Http\Controllers\User\Payment\PaymentControll;
use App\Http\Controllers\User\ProfileControll;
use App\Http\Controllers\user\Search\CategoriesControll;
use App\Http\Controllers\User\SellAndBuyControll;
use App\Mail\Reverse;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group Now create something great!
|
*/
                /////////////////////////////////////////
//////////////////////////////Create And Store User/////////////////////////////////////
         Route::get('register',function() {
               return view('user.register');
         });
         Route::POST('store_user',[AuthController::class,'store'])->name('store_user');
////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){
Route::group(['prefix'=>'user','middleware'=>'auth'],function(){


                                  //////////////////////////////////////////
/////////////////////////////////////////////////////Home////////////////////////////////////////////////
    Route::get('home',[\App\Http\Controllers\HomeController::class,'home'])->name('home');


                                ///////////////////////////////////////////////
////////////////////////////////////////////////All Categories/////////////////////////////////////////
    Route::get('all_categories/{maincategories_id}',[AllCategories::class,'all_categories'])->name('all_categories');


                                  ////////////////////////////////////////
//////////////////////////////////////////////////All Vendors/////////////////////////////////////////////
    Route::get('stores}',[AllStoresControll::class,'stores'])->name('all_stores');


                                  //////////////////////////////////////////////////////
//////////////////////////////////////////////////Search Your Categories//////////////////////////////////////
    Route::POST('search_categories',[CategoriesControll::class,'categories_search'])->name('search_categories');
    Route::get('categories_by_price',[CategoriesControll::class,'categories_by_price'])->name('categories_by_price');


                                   ////////////////////////////////////////////////////
//////////////////////////////////////////////////////Categories Features/////////////////////////////////////////////////
    Route::get('description_category/{subcategory_id}',[DescriptionCategory::class,'description_category'])->name('description_category');


                                       ///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////All Categories Of Parent Sub Category/////////////////////////////////////////////
    Route::get('parents_of_categories/{parent_id}',[AllCategories::class,'categories_from_parent'])->name('categories_from_parent');


                           ///////////////////////////////////////////////
 //////////////////////////////////////////////////Profile////////////////////////////////////////////////////
    Route::get('form_edit_user_profile/{profile_id}',[ProfileControll::class,'form_edit'])->name('form_edit_user_profile');
    Route::POST('edit_user_profile/{profile_id}',[ProfileControll::class,'edit'])->name('edit_user_profile');





                           ////////////////////////////////////
//////////////////////////////////Your Problem about Category//////////////////////////////////////
    Route::POST('review',[ComplaintsOfCategories::class,'review'])->name('review');


                          ///////////////////////////////////////
///////////////////////////////////////Requests and Orders///////////////////////////////////////////
    Route::get('make_over',[ContactControll::class,'make_over'])->name('make_over');
    Route::POST('store_over',[ContactControll::class,'store_over'])->name('store_over');
    Route::get('make_order/{subcategory_id}',[ContactControll::class,'make_order'])->name('make_order');
    Route::POST('store_order',[ContactControll::class,'store_order'])->name('store_order');

                            ////////////////////////////////
/////////////////////////////////////////Electronic payment////////////////////////////////////////////////////////

    Route::get('make_order_electronic/{subcategory_id}',[PaymentControll::class,'make_order'])->name('make_order_electronic');
    Route::POST('checkout_id/{subcategory_id}',[PaymentControll::class,'checkout'])->name('checkout_id');


});

});

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Social Of admin/////////////////////////////////////

Route::get('user/login/{provider}',[LoginRedirectControll::class,'login_redirect'])->name('login_redirect');
Route::get('user/login/{provider}/callback',[LoginRedirectControll::class,'login_redirect_callback']);
















Route::get('fj',function(){
    $users=User::pluck('email')->toArray();
    foreach($users as $user){
        Mail::to($user)->send(new Reverse());
    }
    return 'success';

});
