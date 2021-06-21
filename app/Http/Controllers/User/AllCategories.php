<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Maincategory;
use App\Models\Parentt;
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
        return view('user.allCategories.all_categories',compact('mainncategory','branches','subcategories','maincategories'));
    }

    public function categories_from_parent($parient_id){
        try{
            $categories=Parentt::find($parient_id)->subcategories;
            return view('user.allCategories.all_categories',compact('categories'));
        }catch(\Exception $ex){
            return $ex;
        }
    }
}
