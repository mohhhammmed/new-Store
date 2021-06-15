<?php

namespace App\Http\Controllers\Admin\MainCategories;
use App\Http\Requests\CategoryValid;
use App\Models\Admin;
use App\Models\AverageCategory;
use App\Models\Lang;
use App\Models\Maincategory;
use App\Http\Controllers\Controller;
use App\Models\MainCategoryType;
use App\Models\Parentt;
use App\Models\SubCategory;
use App\Models\TypeAllCat;
use Illuminate\Http\Request;
//use App\Http\Requests\CategoryValid;
use App\Traits\Helper;
use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainCategoriesControll extends Controller
{
    use Helper;


    public function maincategories(){
        $admin=Auth::guard('admin')->user();
        $maincategories=Maincategory::Selection()->where('translation_lang',app()->getLocale())->paginate(paginate_count);

        return view('admin.maincategories.MainCategories',compact('maincategories','admin'));
    }
    public function create(){
        $admin=Auth::guard('admin')->user();
        $types_categories=TypeAllCat::select('type','id')->get();
        $langs=Lang::data();
        return view('admin.maincategories.addCategory',compact('langs','types_categories','admin'));
    }
    public function form_edit($category_id){

        return $this->editCategory($category_id);
    }

    public function edit(CategoryValid $req,$category_id){
       // return $req;
        try {
            $maincategory = Maincategory::find($category_id);
            if (isset($req) && !empty($req) && isset($maincategory) && $maincategory != null) {


            $some_data = $req->category[0];
            $data = Maincategory::get();
            $st = $req->category[0];
            if ($req->has('image')) {
                $st['image'] = $this->setPhoto($req->image, $st['category'], 'admin/images/maincategories');

            } else {
                $st['image'] = $category_id->image;
            }

            if (!isset($st['action'])) {
                $st['action'] = 0;
            }
                    if(file_exists(Maincategory::Image().$maincategory->image) && $maincategory->image !=null)
                    {
                        unlink(Maincategory::Image().$maincategory->image);
                    }

            $maincategory->update($st);
            return redirect(route('form_edit_maincategory',$maincategory->id))->with('success', 'Updated Done');
        }
            return redirect(route('form_edit_maincategory',$maincategory->id))->with('error','There is proplem');
        }catch(\Exception $ex){
            return $ex;
            return redirect(route('form_edit_maincategory',$maincategory->id))->with('error','There is proplem');
        }
    }



    public function store(CategoryValid $r){

        try{
//            $categories=Maincategory::pluck('category')->toArray();
//            if(in_array($r->category[0]['category'],$categories)){
//                return response()->json([
//                    'statue'=>false,
//                    'msg'=>'the category is arready exists'
//                ]);
//            }
            if(isset($r) && !empty($r)) {
                DB::beginTransaction();
//                if ($r->image == null) {
//                    return response()->json([
//                        'statue' => false,
//                        'msg' => 'fill inputs',
//                    ]);
//                }
                $image = $this->setPhoto($r->image, $r->category[0]['category'], 'admin/images/maincategories');
                $data = collect($r->category);
                $data_ar = $data->filter(function ($val, $key) {
                    return $val['translation_lang'] = 'ar';
                });
                if (isset($data_ar[0])) {
                    $data_ar = $data_ar[0];
                    if (!isset($data_ar['action'])) {
                        $data_ar['action'] = 0;
                    }
                    $data_ar['image'] = $image;
                    $data_ar['type_id'] = $r->type_id;

                    $id = Maincategory::insertGetId($data_ar);
                    AverageCategory::create([
                        'maincategory_id' => $id,
                        'average' => $r->average
                    ]);
                } else {
                    $id = 0;
                }
                $data_other = $data->filter(function ($val) {
                    return $val['translation_lang'] !== 'ar';
                });
                // return $data_other[0];
                //  if(isset($data_other[0])){
                foreach ($data_other as $data_cat) {
                    if (!isset($data_cat['action'])) {
                        $data_cat['action'] = 0;
                    }
                    $data_cat['image'] = $image;
                    $data_cat['type_id'] = $r->type_id;
                    $data_cat['translation_of'] = $id;
                    $idd = Maincategory::insertGetId($data_cat);
                    AverageCategory::create([
                        'maincategory_id' => $idd,
                        'average' => $r->average
                    ]);
                }
                DB::commit();
                return response()->json([
                    'statue' => true,
                    'msg' => 'created Done',
                ]);
            }
            return response()->json([
                'statue' => false,
                'msg' => 'your request is not found',
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return $ex;
            return response()->json([
                'statue'=>false,
                'msg'  =>'error',
            ]);

        }

     }
     public function delete(Request $request){
        // return $request;
         return $this->del_ajax($request);
     }
    public function activate_statue(Maincategory $category_id){
        $data_category=$category_id;
        // return $data_category->action;
        if(isset($data_category) && $data_category->count() >0)
        {
            try{
                $statue= $data_category->action==1 ? 0 :1;

                $data_category->update(['action'=>$statue]);
                return redirect(route('store.maincategories'))->with('success','The '. $data_category->category.' category '.'is '.$data_category->getAction());
            }catch(\exception $ex){
                //return $ex;
                return redirect(route('store.maincategories'))->with('error','There is proplem');
            }

        }
    }



}
