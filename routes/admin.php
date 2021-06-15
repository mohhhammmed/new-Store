<?php

//use App\Http\Controllers\store\admin\HomeController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\MainCategories\MainCategoriesControll;
use App\Http\Controllers\Admin\ParentSubCategory;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubCategoriesControll;
use App\Http\Controllers\Admin\Vendors\VendorControll;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutControll;
use App\Http\Controllers\Admin\Langs\LangControll;
use App\Http\Controllers\Admin\CategoryControl;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$paginate_count=define('paginate_count',10);


 Route::prefix( LaravelLocalization::setLocale())->group(function(){
     Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {

                              ////////////////////////////////////////
         ////////////////////////////////////Website Langs////////////////////////////////////////
         Route::get('available_langs',[LangControll::class,'available_langs'])->name('available_langs');

         ////////////////                 /////////////////
/////////////////////////////////////////////// Login Of admin/////////////////////////////////////

         Route::get('login',function(){
             return view('auth.login');
         })->name('login')->middleware('Redir');
         Route::POST('authenticate',[AuthController::class,'authenticate'])->name('authenticate');


     });
 });

// Route::group('prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],function(){

// });


Route::get('/',function(){
  return view('store.the_interface');
 });

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Social Of admin/////////////////////////////////////

Route::get('login/{provider}',[RedirectControler::class,'rdeirectLogin'])->name('login.redirect');
Route::get('login/{provider}/callback',[RedirectControler::class,'rdeirectLoginCallback']);



Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Dashboard Of admin/////////////////////////////////////


    Route::get('dashboard_admin',[Dashboard::class,'Dashboard'])->name('dashboard');

                            ////////////////                 /////////////////
/////////////////////////////////////////////// Profile Of admin/////////////////////////////////////


    Route::get('profile',[ProfileController::class,'profile'])->name('profile');

    Route::POST('edit_prof/{prof_id}',[ProfileController::class,'edit'])->name('edit_profile');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Lang Of admin/////////////////////////////////////


    Route::get('add_lang',[LangControll::class,'create'])->name('create_Lang');
    Route::POST('store_lang',[LangControll::class,'store'])->name('store_lang');
    Route::get('del_lang/{lang_id}',[LangControll::class,'delete'])->name('delete_lang');
    Route::get('form_edit_lang/{lang_id}',[LangControll::class,'form_edit'])->name('form_edit_lang');
    Route::POST('edit_lang/{lang_id}',[LangControll::class,'edit'])->name('edit_lang');
                               ////////////////                 /////////////////
/////////////////////////////////////////////// logout Of admin/////////////////////////////////////

          //Route::get('/mmm',[LogoutControll::class,'mm']);
          Route::get('/logout',[LogoutControll::class,'logout'])->name('store.logout');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Main Categories Of admin/////////////////////////////////////

          Route::get('maincategoriess',[MainCategoriesControll::class,'maincategories'])->name('all_maincategories');
          Route::POST('/store_maincat',[MainCategoriesControll::class,'store'])->name('store_maincategory');
          Route::get('/create_maincat',[MainCategoriesControll::class,'create'])->name('create_maincategory');
        //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_categories');
          Route::get('form_edit_maincat/{maincategory_id}',[MainCategoriesControll::class,'form_edit'])->name('form_edit_maincategory');
          Route::POST('edit_maincat/{maincategory_id}',[MainCategoriesControll::class,'edit'])->name('edit_maincategory');
          Route::get('delete_maincat',[MainCategoriesControll::class,'delete'])->name('delete_maincategory');
          Route::get('change_statue_maincat/{maincategory_id}',[MainCategoriesControll::class,'change_statue'])->name('change_statue_maincategory');


                                    ////////////////                 /////////////////
///////////////////////////////////////////////Parent Sub Categories /////////////////////////////////////

    Route::get('maincategories',[ParentSubCategory::class,'subcategories'])->name('parent_subcategories');
    Route::POST('/store_parent',[ParentSubCategory::class,'store'])->name('store_parent');
    Route::get('/create_parent',[ParentSubCategory::class,'create'])->name('create_parent');
    //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_category');
    Route::get('form_edit/{category_id}',[ParentSubCategory::class,'form_edit'])->name('form_edit_parent');
    Route::POST('edit_maincategory/{category_id}',[ParentSubCategory::class,'edit'])->name('edit_parent');
    Route::get('delete_parent',[ParentSubCategory::class,'delete'])->name('delete_parent');
    Route::get('change_statue/{category_id}',[ParentSubCategory::class,'change_statue'])->name('change_statue_parent');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Sub Categories /////////////////////////////////////

    Route::get('subcategories',[SubCategoriesControll::class,'subcategories'])->name('all_subcategories');
    Route::POST('/store_subcategory',[SubCategoriesControll::class,'store'])->name('store_subcategory');
    Route::get('/create_subcategory',[SubCategoriesControll::class,'create'])->name('create_subcategory');
    //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_category');
    Route::get('form_edit/{category_id}',[SubCategoriesControll::class,'form_edit'])->name('form_edit_subcategory');
    Route::POST('edit_subcategory/{category_id}',[SubCategoriesControll::class,'edit'])->name('edit_subcategory');
    Route::get('delete_subcategory',[SubCategoriesControll::class,'delete'])->name('delete_subcategory');
    Route::get('change_statue_subcat/{subcategory_id}',[SubCategoriesControll::class,'change_statue'])->name('change_statue_subcategory');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// admin Of Vendors/////////////////////////////////////

          Route::get('/all_vendors',[VendorControll::class,'vendors'])->name('all_vendors');
          Route::get('/create',[VendorControll::class,'create'])->name('create_vendor');
          Route::POST('/store_vendor',[VendorControll::class,'store'])->name('store_vendor');
         // Route::get('/vendors',[VendorControll::class,'Vendors'])->name('store_vendor');
          Route::get('/delete_vendor/{vendor_id}',[VendorControll::class,'delete'])->name('delete_vendor');
          Route::get('form_edit/{vendor_id}',[VendorControll::class,'edit'])->name('form_edit_vendor');
          Route::POST('edit_vendor/{vendor_id}',[VendorControll::class,'update'])->name('edit_vendor');
          Route::get('change_statue/{vendorId}',[VendorControll::class,'change_statue'])->name('change_statue_vendor');


});

Route::prefix('store')->group(function(){

});
  route::get('jj',function(){
    return getpath();
  });




  Route::get('j',function(){

      return  Admin::pluck('email')->toArray();
  });




