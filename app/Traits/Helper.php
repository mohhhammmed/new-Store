<?php
namespace App\Traits;
use App\Models\Lang;
use App\Models\Maincategory;
use Illuminate\Support\Facades\Auth;
use Str;
Trait Helper{

       public function setPhoto($image,$name,$path){
          $extension=$image->getClientOriginalExtension();
           $name=$name.time().'.'.$extension;
           $image->move($path,$name);
           return $name;
       }
       public function editCategory($maincategory_id){
             $data_category=Maincategory::with('transes')->find($maincategory_id);
             $langs=Lang::get();
             $admin=Auth::guard('admin')->user();

             return view('admin.maincategories.edit',compact('admin','data_category','langs'));

       }

}
