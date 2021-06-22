<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactValid;
use App\Models\CategoryOfSeller;
use App\Models\Notify;
use App\Models\NotifyOfbuy;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomersOrdersControll extends Controller
{
    public function buy_orders(){

     $orders= CategoryOfSeller::Selection()->paginate(paginate_count);

         $notify=Notify::GetNotifyBuy();
         if(isset($notify) && $notify != null){
             $notify->update([
                 'counter'=>0,
             ]);
         }
         return view('admin.requests.buy_orders',compact('orders'));

    }

    public function delete(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $req=CategoryOfSeller::find($request->id);
                if(isset($req) && $req != null){
                    $req->delete();
                    return response()->json([
                        'statue'=>true,
                        'msg'=>'Deleted Done'
                    ]);
                }
                return response()->json([
                    'statue'=>false,
                    'msg'=>'Not Exists'
                ]);

            }
        }catch(\Exception $ex){
           // return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'There Is Error '
            ]);
        }

    }

    public function sell_order(){
        $orders= Order::Selection()->paginate(paginate_count);
        $notify=Notify::GetNotifyOrder();
        if(isset($notify) && $notify != null){
            $notify->update(['counter'=>0]);
        }
        return view('admin.requests.sell_orders',compact('orders'));

    }

    public function del(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $order=Order::find($request->id);
                if(isset($order) && $order != null){
                    $order->delete();
                    return response()->json([
                        'statue'=>true,
                        'msg'=>'Deleted Done'
                    ]);
                }
                return response()->json([
                    'statue'=>false,
                    'msg'=>'Not Exists'
                ]);

            }
        }catch(\Exception $ex){
            // return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'There Is Error '
            ]);
        }
    }



}
