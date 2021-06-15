<?php

namespace App\Http\Controllers\Admin;
use App\Models\Branch;
use App\Models\Description;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Traits\Helper;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SubCategoriesControll extends Controller
{
    use Helper;
    public function create(){
        $branches=Branch::all();
        $admin=Auth::guard('admin')->user();
        $parentSubCat=Parentt::select('id','type')->where('translation_lang',app()->getLocale())->get();
         $maincategories=Maincategory::select('id','category','translation_lang')->where('translation_lang',app()->getLocale())->get();
             foreach($maincategories as $cat){
                 if(isset($cat->parents[0])){

                     $maincats[]= $cat;
                 }
             }

       $lang_maincategory=Maincategory::where('translation_lang',app()->getLocale())->first();
        return view('admin.subcategories.create',compact('parentSubCat','branches','maincats','lang_maincategory','admin'));
    }
    public function store(ValidSubcategory $request){
       // return $request;

        try{
           DB::beginTransaction();
            $image= $this->setPhoto($request->image,$request->name,'admin/images/subcategories');
            $data=$request->except('image','description','_token');
            $data['image']=$image;
            if(!$request->has('statue')){
                $data['statue']=0;
            }
            //return $data;

           $id=SubCategory::insertGetId($data);
            Description::create([
                'subcategory_id'=>$id,
                'description'=>$request->description,

            ]);
            DB::commit();
            return response()->json([
              'statue'=>true,
              'msg'=>'Created Done',
             ]);

        }catch(\Exception $ex){
            DB::rollBack();
          // return $ex;
            return response()->json([
              'statue'=>false,
              'msg'=>'There is error'
            ]);
        }
     }

     public function subcategories(){
         $admin=Auth::guard('admin')->user();
          $subcategories=SubCategory::with('maincategory')->Selection()->where('translation_lang',app()->getLocale())->paginate(paginate_count);

        return view('admin.subcategories.indexes',compact('subcategories','admin'));
     }
     public function change_statue($subcategory_id){
      //  $subcategories=SubCategory::with('maincategory')->selection();

      try {
        $col=SubCategory::find($subcategory_id);
       // return $col->count();
        if(isset($col)&& $col->count() > 0){
          $statue=$col->statue==1 ? 0 : 1;
          $col->update(['statue'=>$statue]);
      return redirect(route('subcategories'))->with('success','Statue is Updated');
    }
    }catch(\Exception $ex){
        return redirect(route('subcategories'))->with('error','ther is error');
    }
   }

   public function deleteSub(Request $request){
        try{
            if(isset($request->id) && $request->id!=null) {

                $data=SubCategory::find($request->id);
                if(isset($data) && $data!=null){
                    $data->delete();
                    return response()->json([
                        'statue'=>true,
                        'msg'=>'Deleted Done Reload Page',
                    ]);
                }
                return response()->json([
                    'statue'=>false,
                    'msg'=>'column not fount',
                ]);
            }
            return response()->json([
                'statue'=>false,
                'msg'=>'There is Problem',
            ]);

        }catch(\Exception $ex){

            return response()->json([
                'statue'=>false,
                'msg'=>'There is Error',
            ]);
        }

   }


}
