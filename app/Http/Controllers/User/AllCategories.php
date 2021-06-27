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
        if(isset($mainncategory) && $mainncategory != null){

            $typeCategories= $mainncategory->type;
           // $typeMaintCegories=TypeAllCat::where('type',$type)->first();
            $maincategories=$typeCategories->maincategories->where('translation_lang',locale_lang());
            $subcategories= $mainncategory->subcategories()->where('translation_lang',locale_lang())->paginate(paginate_count);
            $branches=Branch::all();
            return view('user.allCategories.all_categories',compact('mainncategory','branches','subcategories','maincategories'));
    
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
