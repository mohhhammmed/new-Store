<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AllCategories;
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

Route::POST('search_categories',[\App\Http\Controllers\user\Search\CategoriesControll::class,'categories_search'])->name('search_categories');

Route::get('categories_by_price',[\App\Http\Controllers\user\Search\CategoriesControll::class,'categories_by_price'])->name('categories_by_price');

Route::get('contact/{subcategory_id}',[\App\Http\Controllers\user\ContactControll::class,'contact'])->name('contact');

Route::get('description_category/{subcategory_id}',[\App\Http\Controllers\user\DescriptionCategory::class,'description_category'])->name('description_category');


Route::get('description_category',[\App\Http\Controllers\user\ContactControll::class,'make_order'])->name('make_order');
