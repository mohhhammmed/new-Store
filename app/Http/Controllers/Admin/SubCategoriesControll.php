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

        $parentSubCat=Parentt::select('id','type')->where('translation_lang',app()->getLocale())->get();
        $lang_maincategory=Maincategory::where('translation_lang',app()->getLocale())->first();
        $maincategories=Maincategory::Selection()->wherehas('parents')->where('translation_lang',app()->getLocale())->get();

             if(isset($maincategories) && count($maincategories) > 0) {
                 return view('admin.subcategories.create', compact('parentSubCat', 'branches', 'maincategories', 'lang_maincategory'));
             }
             return redirect(route('create_parent'));
    }
    public function store(ValidSubcategory $request){
       // return $request;

        try{
           DB::beginTransaction();
            $image= $this->setPhoto($request->image,$request->name,SubCategory::PathImage());
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
           return $ex;
            return response()->json([
              'statue'=>false,
              'msg'=>'There is error'
            ]);
        }
     }

     public function subcategories(){

          $subcategories=SubCategory::with('maincategory')->Selection()->where('translation_lang',app()->getLocale())->paginate(paginate_count);

        return view('admin.subcategories.indexes',compact('subcategories'));
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

   public function delete(Request $request){
        try{
            if(isset($request->id) && $request->id!=null) {

                $subcategory=SubCategory::find($request->id);
                if(isset($subcategory) && $subcategory!=null){
                    if(file_exists(SubCategory::PathImage().$subcategory->image) && $subcategory->image != null)
                    {
                        unlink(SubCategory::PathImage().$subcategory->image);
                    }
                    $subcategory->delete();
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
         // return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'There is Error',
            ]);
        }

   }
        public function form_edit($subcategory_id){

            $subcategory_edit=Subcategory::find($subcategory_id);
            $parentSubCat=Parentt::select('id','type')->where('translation_lang',app()->getLocale())->get();
            $maincategories=Maincategory::Selection()->wherehas('parents')->where('translation_lang',app()->getLocale())->get();

            if(isset($maincategories) && count($maincategories) > 0) {
                return view('admin.subcategories.create', compact('parentSubCat','subcategory_edit',  'maincategories'));
            }
        }

        public function edit(Request $request){
        return $this->editSubcategory($request);
        }

}
