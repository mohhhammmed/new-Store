<?php

namespace App\Http\Controllers\Admin;
use App\Models\Branch;
use App\Models\Lang;
use Auth;
use App\Models\Maincategory;
use App\Models\TypeAllCat;
use App\Models\Subcategory;
use App\Traits\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryValid;
//use DB;
use Illuminate\Support\Facades\DB;

class CategoryControl extends Controller
{

  use Helper;

    public function all_categories($maincategory_id){
          $mainncategory=Maincategory::find($maincategory_id);
     $type= $mainncategory->type->type;
        $typeMaintCegories=TypeAllCat::where('type',$type)->first();
         $maincategories=$typeMaintCegories->maincategories->where('translation_lang',app()->getLocale());
        $subcategories= $mainncategory->subcategories()->paginate(paginate_count);
        $branches=Branch::all();
        return view('admin.allCategories.all_categories',compact('mainncategory','branches','subcategories','maincategories'));
    }

    public function store_categories(Request $req){
        //return $req;
       $image=$this->setPhoto($req->image,$req->category[0]['category'],'store/images/categories');
        $data_category=collect($req->category);
         $ar_category=$data_category->filter(function($val,$key){
               return $val['translation_lang']=='ar';
        });

          try{
               DB::beginTransaction();

               if(isset($ar_category[0])){
                $ar_category=$ar_category[0];

                if(!isset($ar_category['action'])){
                 $ar_category['action']=0;

                }
                $ar_category['image']=$image;


                $id=Maincategory::insertGetId($ar_category);

               }else{
                 $id=0;
               }

                  $other_category=$data_category->filter(function($val,$key){
                        return $val['translation_lang']!='ar';
                 });


                 foreach($other_category as $c){

                     if(!isset($c['action'])){
                        $c['action']=0;
                     }
                     Maincategory::create([
                        'translation_lang'=>$c['translation_lang'],
                        'translation_of'=>$id,
                        'action'=>$c['action'],
                        'category'=>$c['category'],
                        'image'=>$image,
                        'type_id'=>$req->type_id
                     ]);

                 }
               //return 'success';
                    DB::commit();

                return redirect(route('admin.maincategories'))->with('success','category is joined');

             }catch(\Exception $ex){
               return $ex;
              DB::rollback();
               return redirect(route('admin.maincategories'))->with('error','there is proplem');

             }


    }


    public function delete( $category_id){
        $data_category=Maincategory::find($category_id);
        DB::beginTransaction();
        if(isset($data_category) && $data_category->count()>0){
            try{
                $vendors=$data_category->vendors;
                if(isset($vendors) && $vendors->count()>0){
                    foreach($vendors as $vendor){
                        $vendors_names[]= $vendor->name;
                    }
                    if($vendors->count()<=10){
                        $vendors_names=' vendor '.implode(' and ',$vendors_names);

                    }else{$vendors_names='many vendors';}
                    return redirect(route('store.maincategories'))->with('error','The Category is belongs to'.$vendors_names);
                }

                if($data_category->translation_lang=='ar'){
                    unlink(Maincategory::Image().$data_category->image);
                }
                $data_category->delete();
                DB::commit();
                return redirect(route('store.maincategories'))->with('success','The Category is deleted');

            }catch(\Exception $ex){
                // return $ex;
                DB::rollback();
                return redirect(route('store.maincategories'))->with('success','There is error');
            }
        }
        return redirect(route('store.maincategories'))->with('error','The Category is not found');
    }


    public function single_category($category_id){
        $category=SubCategory::find($category_id);
        return view('description_category.category',compact('category'));
    }

}
