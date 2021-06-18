<?php
namespace App\Traits;
use App\Models\Description;
use App\Models\Lang;
use App\Models\Maincategory;
use App\Models\SubCategory;
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
                 if(file_exists(Maincategory::PathImage().$maincategory->image && $maincategory->image!=null)){
                     unlink(Maincategory::PathImage().$maincategory->image);
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

      public function editSubcategory($request){
           try{
               if(isset($request) && !empty($request)){
                   $subcategory=SubCategory::find($request->id);
                   if(isset($subcategory) && $subcategory != null){
                       if(!$request->has('statue'))
                       {
                           $request->merge(['statue'=>0]);
                       }
                       $up_subcategory=$request->except('description');

                       if($request->has('image'))
                       {

                           if(file_exists(SubCategory::PathImage().$subcategory->image) && $subcategory->image != null)
                           {
                               unlink(SubCategory::PathImage().$subcategory->image);
                           }
                           $image=$this->setPhoto($request->image,$request->name,SubCategory::PathImage());
                           $up_subcategory['image']=$image;
                       }

                       $subcategory->description->update($request->all());
                       $subcategory->update($up_subcategory);
                       return response()->json([
                           'statue'=>true,
                           'msg'=>'Updated Done Reload Page'
                       ]);
                   }
                   return response()->json([
                       'statue'=>false,
                       'msg'=>'Not Exists'
                   ]);
               }
           }catch(\Exception $ex){
               return $ex;
           }

      }

}
