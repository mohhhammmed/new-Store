<?php
namespace App\Traits;
use App\Models\Lang;
use App\Models\Maincategory;
use Str;
Trait Helper{

       public function setPhoto($image,$name,$path){
          $extension=$image->getClientOriginalExtension();
           $name=$name.time().'.'.$extension;
           $image->move($path,$name);
           return $name;
       }
       public function editCategory($category_id){
             $data_category=Maincategory::with('transes')->find($category_id);
             $langs=Lang::get();
             return view('admin.main_categories.edit',compact('data_category','langs'));

       }

}
