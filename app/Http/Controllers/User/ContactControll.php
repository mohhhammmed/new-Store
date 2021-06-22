<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesOfSellerValid;
use App\Http\Requests\ContactValid;
use App\Models\CategoryOfSeller;
use App\Models\Maincategory;
use App\Models\Notify;
use App\Models\NotifyOfbuy;
use App\Models\Order;
use App\Traits\Helper;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactControll extends Controller
{
    use Helper;
    public function make_order($subcategory_id){

       $subcategory=SubCategory::find($subcategory_id);
        if(isset($subcategory) && !empty($subcategory)){
            return view('user.contact',compact('subcategory'));
        }
      return redirect()->back()->with('error','This Category not exists');
    }


    public function make_request(){
        $maincategories=Maincategory::Selection()->where('translation_lang',app()->getLocale())->get();
        return view('user.make_request',compact('maincategories'));
    }

    public function store_request(CategoriesOfSellerValid $request){
        try{
            DB::beginTransaction();
            if(isset($request) && !empty($request)) {
                $data=$request->except('image');
                $image=$this->setPhoto($request->image,$request->category,CategoryOfSeller::PathImage());
                $data['image']=$image;
                CategoryOfSeller::create($data);

                $notify=Notify::where('belongs_to_table','categories_of_sellers')->first();

                if(isset($notify) && !empty($notify)){
                    $notify->update([
                        'counter' => $notify->counter + 1,
                    ]);
                }else{
                    Notify::create([
                        'counter'=>1,
                        'belongs_to_table'=>'categories_of_sellers'
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

    public function store_order(ContactValid $request){
        try{
//            DB::beginTransaction();
            if(isset($request) && !empty($request)) {
                $category=SubCategory::find($request->id);
                if(isset($category) && $category != null) {
                    $request->merge(['image' => $category->image,'the_price'=>$category->the_price]);
                    Order::create($request->except('_token','id'));
                   $notify=Notify::where('belongs_to_table','orders')->first();
                   if(isset($notify) && !empty($notify)){
                        $notify->update(['counter' => $notify->counter + 1]);
                    }else
                    {
                        Notify::create([
                            'counter'=>1,
                            'belongs_to_table'=>'orders'

                        ]);
                    }
                   // return $notify=NotifyOfbuy::find(1);
                    return response()->json([
                        'statue' => true,
                        'msg' => 'Your Order is sent',
                    ]);
                }
            }
           // DB::commit();
            return response()->json([
                'statue' => false,
                'msg' => 'Error',
            ]);
        }catch(\Exception $ex){
          //  DB::rollBack();
          //  return $ex;
            return response()->json([
                'statue' => false,
                'msg' => 'There Is Error',
            ]);
        }

    }

}
