<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Maincategory;
use App\Models\TypeAllCat;
use Illuminate\Http\Request;

class AllCategories extends Controller
{
    public function all_categories($maincategory_id){
        $mainncategory=Maincategory::find($maincategory_id);
        $type= $mainncategory->type->type;
        $typeMaintCegories=TypeAllCat::where('type',$type)->first();
        $maincategories=$typeMaintCegories->maincategories->where('translation_lang',app()->getLocale());
        $subcategories= $mainncategory->subcategories()->paginate(paginate_count);
        $branches=Branch::all();
        return view('admin.allCategories.all_categories',compact('mainncategory','branches','subcategories','maincategories'));
    }
}
