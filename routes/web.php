<?php

use App\Http\Controllers\Admin\ComplaintsOfCategories;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AllCategories;
use App\Http\Controllers\User\AllStoresControll;
use App\Http\Controllers\User\ContactControll;
use App\Http\Controllers\User\LoginRedirectControll;
use App\Http\Controllers\User\ProfileControll;
use App\Http\Controllers\user\Search\CategoriesControll;
use App\Http\Controllers\User\SellYourCategory;
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


Route::get('register',function() {
    return view('user.register');
});

Route::POST('store_user',[AuthController::class,'store'])->name('store_user');

Route::group(['prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){

Route::group(['prefix'=>'user','middleware'=>'auth'],function(){

    Route::get('home',[\App\Http\Controllers\HomeController::class,'home'])->name('home');

    Route::get('all_categories/{maincategories_id}',[AllCategories::class,'all_categories'])->name('all_categories');


    Route::get('stores}',[AllStoresControll::class,'stores'])->name('all_stores');

    Route::POST('search_categories',[CategoriesControll::class,'categories_search'])->name('search_categories');

    Route::get('categories_by_price',[CategoriesControll::class,'categories_by_price'])->name('categories_by_price');

    Route::get('contact/{subcategory_id}',[ContactControll::class,'contact'])->name('contact');

    Route::get('description_category/{subcategory_id}',[\App\Http\Controllers\user\DescriptionCategory::class,'description_category'])->name('description_category');

    Route::get('parents_of_categories/{parent_id}',[AllCategories::class,'categories_from_parent'])->name('categories_from_parent');



    Route::get('form_edit_user_profile/{profile_id}',[ProfileControll::class,'form_edit'])->name('form_edit_user_profile');
    Route::POST('edit_user_profile/{profile_id}',[ProfileControll::class,'edit'])->name('edit_user_profile');


    Route::POST('description_category',[ContactControll::class,'make_order'])->name('make_order');



                           ////////////////////////////////////
//////////////////////////////////Your Problem about Category//////////////////////////////////////

    Route::POST('review',[ComplaintsOfCategories::class,'review'])->name('review');


    Route::get('sell',[SellYourCategory::class,'sell'])->name('sell_your_category');
    Route::POST('seller_categories',[SellYourCategory::class,'store'])->name('store_seller_categories');






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
