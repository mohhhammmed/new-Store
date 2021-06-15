<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Maincategory;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AllStoresControll extends Controller
{
    public function stores(){
       $maincategories=Maincategory::GetCategories()->where('translation_lang',app()->getLocale())->get();
   // $all_categories= SubCategory::Selection()->where('translation_lang',app()->getLocale())->paginate(16);
    $vendors=Vendor::Selection()->get();
    return view('user.all_vendors',compact('vendors','maincategories'));
    }
}
