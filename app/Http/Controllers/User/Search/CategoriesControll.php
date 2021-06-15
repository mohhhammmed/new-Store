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
    public function fav_categories(Request $request){
       // return $request;
         $the_price= round($request->the_price);
       $maincategory=Maincategory::find($request->id);
        $average= $maincategory->average->average;
        $precent=$average/2;
          $high_price=$precent+$the_price;
         $low_price=$the_price-$precent;
       $subcategories= $maincategory->subcategories;
            if (isset($average) && isset($subcategories)){
               foreach($subcategories as $sub){
                   if($sub->the_price >= $low_price && $sub->the_price < $high_price) {

                       $your_categories[] = $sub;
                   }
               }

              if(isset($your_categories) && count($your_categories) > 0) {
                  return view('admin.allCategories.all_categories', compact('your_categories', 'maincategory'));
              }
              return redirect()->route('all_categories',$request->id)->with('error','there is not categories');
            }
        return redirect()->route('all_categories',$request->id)->with('error','there is not categories');

    }
    public function your_category(categoriesValid $request){

        try{


              $maincategory=Maincategory::find($request->maincategory_id);
            if(isset($maincategory)&& $maincategory!=null) {

                 $parentscat=$maincategory->parents;
                $yourSubcategories = $maincategory->subcategories;
                $subcats= $yourSubcategories->pluck('name')->toArray();
            }

            if(isset($request)){
                   $statue=in_array($request->category,$subcats);
                     if($statue==true) {
                         foreach ($yourSubcategories as $sub) {
                             if ($sub->name == $request->category) {
                                 $yourCategories[] = $sub;
                             }
                         }
                         if (isset($yourCategories)&&count($yourCategories)>0){
                             return view('admin.allCategories.all_categories', compact('yourCategories'));
                         }
                         return redirect()->route('home',$request->id)->with('error','there is not categories');
                     }
                  $statue= in_array($request->category,$parentscat->pluck('type')->toArray());

                     if($statue == true){
                         foreach ($parentscat as $parent) {

                             if ($parent->type==$request->category) {

                                 foreach ($parent->subcategories as $sub) {
                                     $yourCategories[]= $sub;
                                 }
                             }

                         }

                         if (isset($yourCategories)&&count($yourCategories)>0){
                             return view('admin.allCategories.all_categories', compact('yourCategories' ));
                         }
                         return redirect()->route('home',$request->id)->with('error','there is not categories');
                     }
                return redirect()->route('home',$request->id)->with('error','there is not categories');

           }
        }catch(\Exception $ex){
           // return $ex;
            return redirect(route('home'))->with('error','there is error');
        }

    }

    public function some_category($parient_id){
        try{
            $categories=Parentt::find($parient_id)->subcategories;
            return view('admin.allCategories.all_categories',compact('categories'));
        }catch(\Exception $ex){
            return $ex;
        }



      }
}
