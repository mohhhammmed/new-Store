<?php

//use App\Http\Controllers\store\admin\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\store\Admin\Dashboard;
use App\Http\Controllers\store\Admin\Vendors\VendorControll;
use App\Http\Controllers\store\Admin\LogoutControll;
use App\Http\Controllers\store\Admin\Langs\LangControll;
use App\Http\Controllers\store\HomeController;
use App\Http\Controllers\store\RedirectControler;
use App\Http\Controllers\store\Admin\LoginControl;
use App\Http\Controllers\store\Admin\CategoryControl;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;

$paginate_count=define('paginate_count',10);


// Route::prefix( LaravelLocalization::setLocale())->group(function(){
//     Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {

//     });
// });faadd

// Route::group('prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],function(){

// });


Route::get('/',function(){
  return view('store.the_interface');
 });
                                ////////////////                 /////////////////
/////////////////////////////////////////////// Login Of admin/////////////////////////////////////

               Route::get('login',function(){
                  return view('auth.login');
               })->name('login')->middleware('Redir');
                Route::POST('authenticate',[AuthController::class,'authenticate'])->name('authenticate');
                               ////////////////                 /////////////////
/////////////////////////////////////////////// Social Of admin/////////////////////////////////////

Route::get('login/{provider}',[RedirectControler::class,'rdeirectLogin'])->name('login.redirect');
Route::get('login/{provider}/callback',[RedirectControler::class,'rdeirectLoginCallback']);



Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Dashboard Of admin/////////////////////////////////////


    Route::get('dashboard_admin',[Dashboard::class,'Dashboard'])->name('store.dashboard');



                               ////////////////                 /////////////////
/////////////////////////////////////////////// Lang Of admin/////////////////////////////////////


    Route::get('add_lang',[LangControll::class,'add_lang'])->name('addLang');
    Route::POST('store_lang',[LangControll::class,'store_lang'])->name('store_lang');
    Route::get('available_langs',[LangControll::class,'available_langs'])->name('available_langs');
    Route::get('del_lang/{lang_id}',[LangControll::class,'del_lang'])->name('delLang');
    Route::get('form_edit_lang/{lang_id}',[LangControll::class,'form_edit_lang'])->name('form_edit_lang');
    Route::POST('edit_lang/{lang_id}',[LangControll::class,'edit_lang'])->name('edit_lang');
                               ////////////////                 /////////////////
/////////////////////////////////////////////// logout Of admin/////////////////////////////////////

          //Route::get('/mmm',[LogoutControll::class,'mm']);
          Route::get('/logout',[LogoutControll::class,'logout'])->name('store.logout');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Main Categories Of admin/////////////////////////////////////

    Route::get('main_categories',[CategoryControl::class,'MainCtegories'])->name('store.main_categories');
          Route::get('/categories',[CategoryControl::class,'categoryAdmin'])->name('store.categories');
          Route::get('/add_categories',[CategoryControl::class,'addCategory'])->name('store.addCategories');
          Route::POST('/store_categories',[CategoryControl::class,'store_categories'])->name('store.store_categories');
          Route::get('form_edit_category/{category_id}',[categoryControl::class,'form_edit_category'])->name('form_edit.category');
          Route::POST('edit_category/{category_id}',[categoryControl::class,'edit_category'])->name('edit.category');
          Route::get('delete_category/{category_id}',[categoryControl::class,'delete'])->name('category.delete');
          Route::get('activate_category/{category_id}',[categoryControl::class,'activate_statue'])->name('category.activate');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// admin Of Vendors/////////////////////////////////////


    Route::get('/createVendor',[VendorControll::class,'create'])->name('store.createVendor');
          Route::POST('/storeVendor',[VendorControll::class,'store'])->name('store.storeVendor');
          Route::get('/vendors',[VendorControll::class,'Vendors'])->name('store.vendors');
          Route::get('/delete/{vendor_id}',[VendorControll::class,'delete'])->name('vendor.delete');
          Route::get('edit/{vendor_id}',[VendorControll::class,'edit'])->name('vendor.edit');
          Route::POST('update/{vendor_id}',[VendorControll::class,'update'])->name('vendor.update');
          Route::get('change_statue/{vendorId}',[VendorControll::class,'change_statue'])->name('change.statue');

                                ////////////////                 /////////////////
/////////////////////////////////////////////// Sub Categories Of Admin/////////////////////////////////////


    Route::get('/create',[VendorControll::class,'create'])->name('admin.create_sub_vendor');
    Route::POST('/store',[VendorControll::class,'store'])->name('admin.store_sub_vendor');
    Route::get('/sub_vendors',[VendorControll::class,'sub_vendors'])->name('admin.sub_vendors');
    Route::get('/delete/{sub_vendors_id}',[VendorControll::class,'delete'])->name('admin.delete_sub_vendor');
    Route::get('edit/{sub_vendors_id}',[VendorControll::class,'edit'])->name('admin.edit_sub_vendor');
    Route::POST('update/{sub_vendors_id}',[VendorControll::class,'update'])->name('admin.update_sub_vendor');
    Route::get('change_statue/{sub_vendors_id}',[VendorControll::class,'change_statue'])->name('aadmin.change_statue');

});

Route::prefix('store')->group(function(){

});
  route::get('jj',function(){
    return getpath();
  });




  Route::get('j',function(){

      return  Admin::pluck('email')->toArray();
  });




