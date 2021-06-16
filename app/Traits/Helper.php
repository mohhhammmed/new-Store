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
             $data_category=Maincategory::with('translations')->find($maincategory_id);
             $langs=Lang::get();
             $admin=Auth::guard('admin')->user();

             return view('admin.maincategories.edit',compact('admin','data_category','langs'));

       }
       public function del_ajax($request){
        //   return $request;
           if(isset($request) && !empty($request)) {
               $maincategory= Maincategory::find($request->id);
               if(isset($maincategory) && $maincategory!= null){
                 if(file_exists(Maincategory::Image().$maincategory->image && $maincategory->image!=null)){
                     unlink(Maincategory::Image().$maincategory->image);
                 }
                 $maincategory->delete();
                 return response()->json([
                     'statue'=>true,
                     'msg'=>'Deleted Done'
                 ]);
               }
               return response()->json([
                   'statue'=>false,
                   'msg'=>'Not Found'
               ]);
           }
           return response()->json([
               'statue'=>false,
               'msg'=>'Not Found'
           ]);
      }

}
