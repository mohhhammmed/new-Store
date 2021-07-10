<?php

namespace App\Http\Controllers\user\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoriesValid;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\Subcategory;
use App\Models\ShoppingCart;
use Auth;
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
                        $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->get();
                        return view('user.allCategories.all_categories', compact('subcategories_cart','your_categories', 'maincategory'));
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

                $maincategories = Maincategory::where('category','like','%'.$request->category.'%')->where('translation_lang', app()->getLocale())->select('category')->get();
                $subcategories = Subcategory::where('name','like','%'.$request->category.'%')->where('translation_lang', app()->getLocale())->select('name')->get();
                $parents_subcategories = Parentt::where('type','like','%'.$request->category.'%')->where('translation_lang', app()->getLocale())->select('type')->get();

              if(isset($maincategories) || isset($subcategories) || isset($parents_subcategories)) {

                if ($parents_subcategories->count() > 0) {
                    foreach ($parents_subcategories as $parent) {
                        $yourCategories = Parentt::where('type', $parent->type)->first()->subcategories;
                    }
                }


                  if ($subcategories->count() > 0) {
                      foreach ($subcategories as $subcat) {
                          $yourCategories = Subcategory::where('name', $subcat->name)->get();
                      }
                  }

                  if ($maincategories->count() > 0) {
                    foreach ($maincategories as $maincat) {
                      $yourCategories =Maincategory::where('category',$maincat->category)->first()->subcategories;
                    }
                }

                  if(isset($yourCategories) && count($yourCategories) > 0) {
                    $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->get();
                      return view('user.allCategories.all_categories', compact('subcategories_cart','yourCategories'));
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
