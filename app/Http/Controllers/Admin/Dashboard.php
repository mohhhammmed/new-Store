<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Maincategory;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeAllCat;

class Dashboard extends Controller
{


    public function Dashboard(){
       // return TypeAllCat::find(1)->maincategories;
       $type_categories= TypeAllCat::wherehas('maincategories')->where('translation_lang',locale_lang())->get();
       //$subcategories=SubCategory::Selection()->where('translation_lang',locale_lang())->paginate(paginate_count);

        return view('admin.dashboard.dashboard',compact('type_categories'));
    }
}
