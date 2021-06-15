<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ParentSubCategory extends Controller
{
    public function create(){
        $maincategories=Maincategory::select('id','category')->where('translation_lang',app()->getLocale())->get();
        $subcategories=SubCategory::select('id','name')->get();
        $admin=Auth::guard('admin')->user();
        return view('admin.maincategories.type_maincategories',compact('admin','maincategories','subcategories'));
    }


    public function store(Request $request){
        try{
            $valid=Validator::make($request->all(),[
                'maincategory_id'=>'required|numeric|exists:maincategories,id',
                'type'=>'required|string',
                'translation_lang'=>'required|max:8'
            ]);
            if($valid->fails()){
                return response()->json([
                    'statue'=>false,
                    'errors'=>$valid->errors(),

                ]);
            }
            if(isset($request)) {
                Parentt::create($request->all());
                return response()->json([
                    'statue'=>true,
                    'msg'=>'Created Done'
                ]);
            }
        }catch(\Exception $ex){
            //return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'there is error'
            ]);
        }

    }

}
