<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactValid;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;

class ContactControll extends Controller
{
    public function contact($subcategory_id){
       $subcategory=SubCategory::find($subcategory_id);

      return view('user.contact',compact('subcategory'));
    }
    public function make_order(ContactValid $request){
       if(isset($request) && !empty($request)) {

           return response()->json([
               'statue' => true,
               'msg' => 'Your Order is sent',
           ]);
       }
    }
}
