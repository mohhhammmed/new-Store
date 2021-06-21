<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesOfSellerValid;
use App\Models\CategoryOfSeller;
use App\Models\Maincategory;
use App\Models\Notify;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellYourCategory extends Controller
{
    use Helper;
   public function sell(){
       $maincategories=Maincategory::Selection()->where('translation_lang',app()->getLocale())->get();
       return view('user.sell_your_category',compact('maincategories'));
   }

   public function store(CategoriesOfSellerValid $request){
       try{
           DB::beginTransaction();
           if(isset($request) && !empty($request)) {
               $data=$request->except('image');
               $image=$this->setPhoto($request->image,$request->category,CategoryOfSeller::PathImage());
               $data['image']=$image;
               CategoryOfSeller::create($data);

                $counter=Notify::find(1);
                if(isset($counter) && !empty($counter)){
                   $counter->update([
                       'counter' => $counter->counter + 1,
                   ]);
               }

               DB::commit();

               return response()->json([
                   'statue'=>true,
                   'msg'=>'Your Request Is Sent'
               ]);
           }
           return response()->json([
               'statue'=>false,
               'msg'=>'Error'
           ]);
       }catch(\Exception $ex){
           DB::rollBack();
          // return $ex;
           return response()->json([
               'statue'=>false,
               'msg'=>'Error'
           ]);
       }

   }
}
