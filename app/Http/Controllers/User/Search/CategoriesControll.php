<?php

namespace App\Http\Controllers\user\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoriesValid;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoriesControll extends Controller
{
    public function categories_by_price(Request $request){
       // return $request;
        if(isset($request) && !empty($request)) {
            $the_price = round($request->the_price);
            $maincategory = Maincategory::find($request->id);
            if(isset($maincategory) && isset($the_price) &&$maincategory != null && $the_price != 0 ) {
                $average = $maincategory->average->average;
                $precent = $average / 2;
                $high_price = $precent + $the_price;
                $low_price = $the_price - $precent;
                $subcategories = $maincategory->subcategories;
                if (isset($average) && isset($subcategories)) {
                    foreach ($subcategories as $sub) {
                        if ($sub->the_price >= $low_price && $sub->the_price < $high_price) {

                            $your_categories[] = $sub;
                        }
                    }

                    if (isset($your_categories) && count($your_categories) > 0) {
                        return view('user.allCategories.all_categories', compact('your_categories', 'maincategory'));
                    }
                    return redirect()->route('all_categories', $request->id)->with('error', 'there is not categories');
                }
                return redirect()->back()->with('error', 'there is not categories');
            }
            return redirect()->back();
        }
    }
    public function categories_search(categoriesValid $request){

        try{
            if(isset($request) && !empty($request)) {

                $maincategories = Maincategory::where('translation_lang', app()->getLocale())->pluck('category')->toArray();
                $subcategories = SubCategory::where('translation_lang', app()->getLocale())->pluck('name')->toArray();
                $parents_subcategories = Parentt::where('translation_lang', app()->getLocale())->pluck('type')->toArray();

              if(isset($maincategories) || isset($subcategories) || isset($parents_subcategories)) {

                  $statue_1 = in_array($request->category, $maincategories);
                  $statue_2 = in_array($request->category, $subcategories);
                  $statue_3 = in_array($request->category, $parents_subcategories);

                  if ($statue_1 == true) {
                      foreach ($maincategories as $maincat) {
                          if ($maincat == $request->category) {
                              $yourCategories = Maincategory::where('category', $maincat)->first()->subcategories;
                          }
                      }
                  }


                  if ($statue_2 == true) {
                      foreach ($subcategories as $subcat) {
                          if ($subcat == $request->category) {
                              $yourCategories = SubCategory::where('name', $subcat)->get();
                          }
                      }
                  }

                  if ($statue_3 == true) {
                      foreach ($parents_subcategories as $parent) {
                          if ($parent == $request->category) {
                              $yourCategories = Parentt::where('type', $parent)->first()->subcategories;
                          }
                      }
                  }
                  if(isset($yourCategories) && count($yourCategories) > 0) {
                      return view('user.allCategories.all_categories', compact('yourCategories'));
                  }
              }
                return redirect()->back()->with('error','Categories Not Exists');
            }
        }catch(\Exception $ex){
           return $ex;
            return redirect(route('home'))->with('error','there is error');
        }

    }


}
