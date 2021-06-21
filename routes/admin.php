<?php

//use App\Http\Controllers\store\admin\HomeController;
use App\Http\Controllers\Admin\ComplaintsOfCategories;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\MainCategories\MainCategoriesControll;
use App\Http\Controllers\Admin\ParentSubCategory;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Requests\RequestControll;
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
/////////////////////////////////////////////// Login /////////////////////////////////////

         Route::get('login',function(){
             return view('auth.login');
         })->name('login')->middleware('Redir');
         Route::POST('authenticate',[AuthController::class,'authenticate'])->name('authenticate');


     });
 });
                    /////////////////////////////////////////
////////////////////////////////////////Inter Favce///////////////////////////
            Route::get('/',function(){
                return view('the_interface');
            });

                             ////////////////                 /////////////////
/////////////////////////////////////////////// logout Of admin/////////////////////////////////////


Route::get('/logout',[LogoutControll::class,'logout'])->name('logout');


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){


Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Dashboard Of admin/////////////////////////////////////


    Route::get('dashboard_admin',[Dashboard::class,'Dashboard'])->name('dashboard');

                            ////////////////                 /////////////////
/////////////////////////////////////////////// Profile Of admin/////////////////////////////////////


    Route::get('form_edit_profile/{prof_id}',[ProfileController::class,'form_edit'])->name('form_edit_profile');
    Route::POST('edit_prof/{prof_id}',[ProfileController::class,'edit'])->name('edit_profile');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Lang Of admin/////////////////////////////////////


    Route::get('add_lang',[LangControll::class,'create'])->name('create_Lang');
    Route::POST('store_lang',[LangControll::class,'store'])->name('store_lang');
    Route::POST('del_lang',[LangControll::class,'delete'])->name('delete_lang');
    Route::get('form_edit_lang/{lang_id}',[LangControll::class,'form_edit'])->name('form_edit_lang');
    Route::POST('edit_lang',[LangControll::class,'edit'])->name('edit_lang');
    Route::get('change_statue/{lang_id}',[LangControll::class,'change_statue'])->name('change_statue_lang');




                               ////////////////                 /////////////////
/////////////////////////////////////////////// Main Categories Of admin/////////////////////////////////////

          Route::get('maincategoriess',[MainCategoriesControll::class,'maincategories'])->name('all_maincategories');
          Route::POST('/store_maincat',[MainCategoriesControll::class,'store'])->name('store_maincategory');
          Route::get('/create_maincat',[MainCategoriesControll::class,'create'])->name('create_maincategory');
        //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_categories');
          Route::get('form_edit_maincat/{maincategory_id}',[MainCategoriesControll::class,'form_edit'])->name('form_edit_maincategory');
          Route::POST('edit_maincat/{maincategory_id}',[MainCategoriesControll::class,'edit'])->name('edit_maincategory');
          Route::POST('delete_maincat',[MainCategoriesControll::class,'delete'])->name('delete_maincategory');
        //  Route::get('change_statue_maincat/{maincategory_id}',[MainCategoriesControll::class,'change_statue'])->name('change_statue_maincategory');


                                    ////////////////                 /////////////////
///////////////////////////////////////////////Parent Sub Categories /////////////////////////////////////

    Route::get('maincategories',[ParentSubCategory::class,'subcategories'])->name('parent_subcategories');
    Route::POST('/store_parent',[ParentSubCategory::class,'store'])->name('store_parent');
    Route::get('/create_parent',[ParentSubCategory::class,'create'])->name('create_parent')->middleware('RedirMainCat');
    //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_category');
    Route::get('form_edit_parent/{category_id}',[ParentSubCategory::class,'form_edit'])->name('form_edit_parent');
    Route::POST('edit_maincategory/{category_id}',[ParentSubCategory::class,'edit'])->name('edit_parent');
    Route::get('delete_parent',[ParentSubCategory::class,'delete'])->name('delete_parent');
    Route::get('change_statue/{category_id}',[ParentSubCategory::class,'change_statue'])->name('change_statue_parent');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Sub Categories /////////////////////////////////////

    Route::get('subcategories',[SubCategoriesControll::class,'subcategories'])->name('all_subcategories');
    Route::POST('/store_subcategory',[SubCategoriesControll::class,'store'])->name('store_subcategory');
    Route::get('/create_subcategory',[SubCategoriesControll::class,'create'])->name('create_subcategory')->middleware('RedirMainCat');
    //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_category');
    Route::get('form_edit_subcategories/{category_id}',[SubCategoriesControll::class,'form_edit'])->name('form_edit_subcategory');
    Route::POST('edit_subcategory',[SubCategoriesControll::class,'edit'])->name('edit_subcategory');
    Route::POST('delete_subcategory',[SubCategoriesControll::class,'delete'])->name('delete_subcategory');
    Route::get('change_statue_subcat/{subcategory_id}',[SubCategoriesControll::class,'change_statue'])->name('change_statue_subcategory');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// admin Of Vendors/////////////////////////////////////

          Route::get('/all_vendors',[VendorControll::class,'vendors'])->name('all_vendors');
          Route::get('/create',[VendorControll::class,'create'])->name('create_vendor')->middleware('RedirMainCat');
          Route::POST('/store_vendor',[VendorControll::class,'store'])->name('store_vendor');
         // Route::get('/vendors',[VendorControll::class,'Vendors'])->name('store_vendor');
          Route::POST('/delete_vendor',[VendorControll::class,'delete'])->name('delete_vendor');
          Route::get('form_edit_vendor/{vendor_id}',[VendorControll::class,'form_edit'])->name('form_edit_vendor');
          Route::POST('edit_vendor',[VendorControll::class,'edit'])->name('edit_vendor');
          Route::POST('change_statue',[VendorControll::class,'change_statue'])->name('change_statue_vendor');

    Route::get('/all_requests',[RequestControll::class,'requests'])->name('all_requests');
//    Route::get('/create',[VendorControll::class,'create'])->name('create_vendor')->middleware('RedirMainCat');
//    Route::POST('/store_vendor',[VendorControll::class,'store'])->name('store_vendor');
//    // Route::get('/vendors',[VendorControll::class,'Vendors'])->name('store_vendor');
    Route::POST('/delete_request',[RequestControll::class,'delete'])->name('delete_request');
//    Route::get('form_edit_vendor/{vendor_id}',[VendorControll::class,'form_edit'])->name('form_edit_vendor');
//    Route::POST('edit_vendor',[VendorControll::class,'edit'])->name('edit_vendor');
//    Route::POST('change_statue',[VendorControll::class,'change_statue'])->name('change_statue_vendor');


});
});
//
//Route::get('trashed',function(){
//    $ss= \App\Models\CategoryOfSeller::withTrashed()->get();
//    foreach($ss as $s) {
//        if ($s->trashed()) {
//           echo $s;
//        }
//    }
//    return 'sdfkjsdhf';
//});




Route::prefix('store')->group(function(){

});
  route::get('jj',function(){
    return getpath();
  });




  Route::get('j',function(){

      return  Admin::pluck('email')->toArray();
  });




