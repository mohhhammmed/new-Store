<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AllCategories;
use App\Http\Controllers\User\AllStoresControll;
use App\Http\Controllers\User\LoginRedirectControll;
use Illuminate\Support\Facades\Route;

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


Route::get('register',function() {
    return view('user.register');
});

Route::POST('store_user',[AuthController::class,'store'])->name('store_user');

Route::get('home',[\App\Http\Controllers\HomeController::class,'home'])->name('home');

Route::get('all_categories/{maincategories_id}',[AllCategories::class,'all_categories'])->name('all_categories');


Route::get('stores}',[AllStoresControll::class,'stores'])->name('all_stores');



Route::POST('search_categories',[\App\Http\Controllers\user\Search\CategoriesControll::class,'categories_search'])->name('search_categories');

Route::get('categories_by_price',[\App\Http\Controllers\user\Search\CategoriesControll::class,'categories_by_price'])->name('categories_by_price');

Route::get('contact/{subcategory_id}',[\App\Http\Controllers\user\ContactControll::class,'contact'])->name('contact');

Route::get('description_category/{subcategory_id}',[\App\Http\Controllers\user\DescriptionCategory::class,'description_category'])->name('description_category');


Route::get('profile',[\App\Http\Controllers\User\ProfileControll::class,'profile'])->name('user_profile');


Route::get('description_category',[\App\Http\Controllers\user\ContactControll::class,'make_order'])->name('make_order');
////////////////                 /////////////////
/////////////////////////////////////////////// Social Of admin/////////////////////////////////////

Route::get('user/login/{provider}',[LoginRedirectControll::class,'login_redirect'])->name('login_redirect');
Route::get('user/login/{provider}/callback',[LoginRedirectControll::class,'login_redirect_callback']);
