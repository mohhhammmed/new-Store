<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class ContactControll extends Controller
{
    public function contact($subcategory_id){
       $subcategory=SubCategory::find($subcategory_id);
      return view('user.contact',compact('subcategory'));
    }
    public function make_order(Request $request){
       // return 'hdsjdsk';

        return response()->json([
            'statue'=>true,
            'msg'=>'Your Order is sent',
        ]);
       //  return $request;
    }
}
