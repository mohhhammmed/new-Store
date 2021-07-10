<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\Payment\PaymentControll;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesOfSellerValid;
use App\Http\Requests\ContactValid;
use App\Models\Over;
use App\Models\Maincategory;
use App\Models\Notify;
use App\Models\ShoppingCart;
use App\Models\NotifyOfbuy;
use App\Models\Order;
use App\Traits\Helper;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactControll extends Controller
{
    use Helper;

    public function make_order()
    {
        $user= Auth::user();
        $user_subcategories=$user->subcategories;
          $total_price=0;
        if (isset($user_subcategories) && $user_subcategories->count() > 0) {

            foreach($user_subcategories as $subcategory){
               $total_price+=$subcategory->the_price;
            }

            return view('user.contact.make_order', compact('total_price','user_subcategories'));
        }
        return redirect(route('home'))->with('error','Categories Not Found');

    }


    public function make_over()
    {
        $maincategories = Maincategory::Selection()->where('translation_lang', app()->getLocale())->get();
        return view('user.contact.make_over', compact('maincategories'));
    }

    public function store_over(CategoriesOfSellerValid $request)
    {
        try {
            DB::beginTransaction();
            if (isset($request) && !empty($request)) {
                $data = $request->except('image');
                $image = $this->setPhoto($request->image, $request->category, Over::PathImage());
                $data['image'] = $image;
                Over::create($data);

                $notify = Notify::where('belongs_to_table', 'overs')->first();

                if (isset($notify) && !empty($notify)) {
                    $notify->update([
                        'counter' => $notify->counter + 1,
                    ]);
                } else {
                    Notify::create([
                        'counter' => 1,
                        'belongs_to_table' => 'overs'
                    ]);
                }

                DB::commit();

                return response()->json([
                    'statue' => true,
                    'msg' => 'Your Over Is Sent'
                ]);
            }
            return response()->json([
                'statue' => false,
                'msg' => 'Error'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
             return $ex;
            return response()->json([
                'statue' => false,
                'msg' => 'Error'
            ]);
        }

    }

    public function store_order(ContactValid $request)
    {

        try{
            DB::beginTransaction();
            if(isset($request) && !empty($request)) {
                $subcategories_user=Auth::user()->subcategories;
                $total_price=0;
                if(isset($subcategories_user) && $subcategories_user->count() > 0) {
                    foreach($subcategories_user as $subcategory){
                        $subcategories_names[]=$subcategory->name;
                        $subcategories_images[]=$subcategory->image;
                        $total_price += $subcategory->the_price;
                    }

                    $category=implode(',',$subcategories_names);
                    $image=implode(',',$subcategories_images);

                    $request->merge(['image' => $image,'category'=>$category,'the_price'=>$total_price]);
                    Order::create($request->all());
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
                    DB::commit();
                    return response()->json([
                        'status' => true,
                        'msg' => 'Your Order is sent',
                    ]);
                }
            }

            return response()->json([
                'statue' => false,
                'msg' => 'Error',
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
           return $ex;
            return response()->json([
                'statue' => false,
                'msg' => 'There Is Error',
            ]);
        }

    }

    public function conditions(){
        return view('user.contact.conditions');
    }


    public function shopping_cart(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $subcategories_id=Subcategory::pluck('id')->toArray();
                 if(in_array($request->subcategory_id,$subcategories_id)){
                     $request->merge(['user_id'=>Auth::id()]);
                    ShoppingCart::create($request->all());
                    return get_response(true,'success');
                 }
                 return get_response(false,'Not Found');
             }
        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'Error');
        }

    }

    public function delete_cart_subcategory(Request $request){
        $subcategory_user= ShoppingCart::where('subcategory_id',$request->id)->first();
        if(isset($subcategory_user) && $subcategory_user->count() >0){
            $subcategory_user->delete();
            return get_response(true,'Deleted Done');
        }
        return get_response(false,'Not Found');
    }


}
