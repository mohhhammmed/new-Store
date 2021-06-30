<?php

namespace App\Http\Controllers;


use App\Models\Subcategory;
use App\Models\User;
//use App\Models\Maincategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\TypeAllCat;
use App\Models\Maincategory;

use Auth;
class HomeController extends Controller
{
    public function home(){
        $maincategories=Maincategory::with('parents')->Selection()->where('translation_lang',app()->getLocale())->get();

        $main_categories_byType=TypeAllCat::with(['maincategories'=>function($q){
         $q->select('category','translation_lang','type_id','id')->where('translation_lang',app()->getLocale());
        }])->select('id','type')->where('translation_lang',app()->getLocale())->get();
      //  $types=TypemainCat::all();
        $subcategories=Subcategory::select('id','name','image','maincategory_id','the_price')->where('translation_lang',app()->getLocale())->get();


        return view('home.index',compact('maincategories','main_categories_byType','subcategories'));
    }

}

