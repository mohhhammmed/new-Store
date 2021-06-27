<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactValid;
use App\Models\ClientChekoutId;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class PaymentControll extends Controller
{
    public function checkout(Request $request,$subcategory_id)
    {

       $subcategory=SubCategory::find($subcategory_id);
        $url = env('HYPERPAY_URL') . "v1/checkouts";
        $data = "entityId=" . env('HYPERPAY_ENTITY_ID') .
            "&amount=" . $subcategory->the_price .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.env('HAYPERPAY_AUTH_KEY')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('HAYPERPAY_PRODUCTION'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData= json_decode($responseData,true);
       // $res = json_decode($responseData, true);

       return view('user.paying_off.payment')->with(['responseData' => $responseData , 'id' => $subcategory->id]);

//        ->renderSections();
//        return response()->json([
//            'status' => true,
//            'content' => $view['content']
//        ]);
    }

    public function make_order($subcategory_id){
        $subcategory=Subcategory::find($subcategory_id);
        if (request('id') && request('resourcePath')) {

             $statuePayment = $this->paymentStatue( request('resourcePath'));

            if(isset($statuePayment['id'])){

                ClientChekoutId::create([
                    'checkout_id'=>$statuePayment['id'],
                ]);
                return redirect(route('make_order_electronic',$subcategory->id))->with('success','تمت العمليه بنجاح');

            }
            return redirect(route('make_order_electronic',$subcategory->id))->with('error','فشلت عمليه الدفع');
        }

        return view('user.paying_off.payment',compact('subcategory'));

}

    public function paymentStatue($resourcepath){

        $url = env('HYPERPAY_URL').$resourcepath;
        $url .= "?entityId=" . env('HYPERPAY_ENTITY_ID');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.env('HAYPERPAY_AUTH_KEY')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  env('HAYPERPAY_PRODUCTION'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData,true);


    }



}
