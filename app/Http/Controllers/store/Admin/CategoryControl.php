<?php

namespace App\Http\Controllers\store\Admin;
use App\Models\Lang;
use Auth;
use App\Models\Maincategory;
use App\Traits\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryValid;
//use DB;
use Illuminate\Support\Facades\DB;

class CategoryControl extends Controller
{

  use Helper;


  public function MainCtegories(Maincategory $cat){
    
    $categories=$cat->getCategories();
    return view('admin.main_categories.MainCategories',compact('categories',$categories));
}



    public function categoryAdmin(){

        return view('admin.main_categories.all_categories');
    }
    public function addCategory(){


    $langs=Lang::data();
        return view('admin.main_categories.addCategory',compact('langs',$langs));
    }
    public function store_categories(CategoryValid $req){
       // return $req->category;
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
                     ]);

                 }
               //return 'success';
                    DB::commit();

                return redirect(route('store.main_categories'))->with('success','category is joined');

             }catch(\Exception $ex){
              // return $ex;
              DB::rollback();
               return redirect(route('store.main_categories'))->with('error','there is proplem');

             }


    }
    public function form_edit_category($category_id){

        return $this->editCategory($category_id);
    }
    public function edit_category(CategoryValid $req,Maincategory $category_id){

       //return $req;
     try{
         $some_data = $req->category[0];
         $data = Maincategory::get();
      $st= $req->category[0];
      if($req->has('image')){
      $st['image']=$this->setPhoto($req->image,$st['category'],'store/images/categories');

    }else{
      $st['image']=$category_id->image;
    }

    if(!isset($st['action'])){
      $st['action']=0;
    }

         foreach ($data as $d) {
             if ($d->translation_lang == $some_data['translation_lang'] && $some_data['category'] == $d->category && $d->action== $st['action']) {
                 return redirect(route('store.main_categories'))->with('error','The Main Category Is Found');
             }
         }
         $category_id->update($st);
           return redirect(route('store.main_categories'))->with('success','Updated Done');
     }catch(\Exception $ex){
      return redirect(route('store.main_categories'))->with('error','There is proplem');
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
                            return redirect(route('store.main_categories'))->with('error','The Category is belongs to'.$vendors_names);
                          }
                          $category_ar=$data_category->translation_lang=='ar'?$data_category:'';
                          if(!empty($category_ar)){
                            unlink(Maincategory::Image().$data_category->image);
                           }
                          $data_category->delete();
                          DB::commit();
                          return redirect(route('store.main_categories'))->with('success','The Category is deleted');

                  }catch(\Exception $ex){
                   // return $ex;
                    DB::rollback();
                    return redirect(route('store.main_categories'))->with('success','There is error');
                  }
              }
                 return redirect(route('store.main_categories'))->with('error','The Category is not found');
    }

    public function activate_statue(Maincategory $category_id){
            $data_category=$category_id;
           // return $data_category->action;
            if(isset($data_category) && $data_category->count() >0)
            {
              try{
                $statue= $data_category->action==1 ? 0 :1;

                $data_category->update(['action'=>$statue]);
                return redirect(route('store.main_categories'))->with('success','The '. $data_category->category.' category '.'is '.$data_category->getAction());
              }catch(\exception $ex){
                //return $ex;
                return redirect(route('store.main_categories'))->with('error','There is proplem');
              }

            }
    }
}
