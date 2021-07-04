<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\Branch;
use Illuminate\Http\Request;

class AllCategories extends Controller
{
    public function all_categories($maincategory_id){
        $mainncategory=Maincategory::find($maincategory_id);
        if(isset($mainncategory) && $mainncategory != null){

            $branche= $mainncategory->branch;
            $subcategories= $mainncategory->subcategories()->paginate(paginate_count);
            $maincategories=$branche->maincategories->where('translation_lang',locale_lang());
            $governorates=Governorate::where('translation_lang',locale_lang())->get();
            return view('user.allCategories.all_categories',compact('mainncategory','governorates','subcategories','maincategories'));

        }
        return redirect()->back()->with('error','Categories Not Exists');


    }

    public function categories_from_parent($parient_id){
        try{
          $parent=Parentt::find($parient_id);
            if(isset($parent) && $parent->count() > 0) {
                $categories=$parent->subcategories;
                return view('user.allCategories.all_categories', compact('categories'));
            }
            return redirect()->back()->with('error','Categories Not Exists');
        }catch(\Exception $ex){
            return $ex;
        }
    }
}
