<?php

namespace App\Http\Controllers\Admin\Langs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Maincategory;
use Auth;
class LangControll extends Controller
{


    public function create(){
        $admin=Auth::guard('admin')->user();
        return view('admin.langs.add_lang',compact('admin'));
    }
    public function store(ValidLang $request){

       // return response()->json($req->all());

        try{
            if(isset($request) && !empty($request)) {
                $statue = $request->statue;
                $data = $request->except('_token');
                Lang::create([
                    'abbr' => $data['abbr'],
                    'name' => $data['name'],
                    'direction' => $data['direction'],
                    'statue' => $statue[0]
                ]);
                return response()->json([
                    'statue' => true,
                    'msg' => 'created done'
                ]);
            }
            return response()->json([
                'statue'=>false,
                'msg'=>'Request not  found'
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'statue'=>false,
                'msg'=>'created falis'
            ]);
        }
    }
    public function available_langs(){
        $langs= Lang::Data()->paginate(paginate_count);
        $admin=Auth::guard('admin')->user();
        $user=Auth::guard('web')->user();
        return view('admin.langs.available_langs',compact('langs','admin','user'));
    }

       public function delete(Request $request){
        if(isset($request) && !empty($request)) {
            $data = Lang::where('id', $request->id)->first();
            if (isset($data) && $data != null) {
                $data->delete();
                return response()->json([
                    'statue' => true,
                    'msg' => 'Deleted Done'
                ]);
            }
            return response()->json([
                'statue'=>false,
                'msg'=>'Deleted fails'
            ]);
        }

    }


    public function form_edit($lang_id){
        $data_lang=Lang::data()->find($lang_id);
        $admin=Auth::guard('admin')->user();
        return view('admin.langs.add_lang',compact('admin','data_lang'));
    }

    public function edit(ValidLang $request){

       try{
           if(isset($request) && !empty($request)) {
               $data_lang = Lang::find($request->id);
               if (isset($data_lang) && $data_lang != null) {
                     $up_lang=$request->except('statue');
                    $up_lang['statue']=$request->statue[0];
                   $data_lang->update($up_lang);
                   return response()->json([
                       'statue' => true,
                       'msg' => 'Updated Done',
                   ]);
               }
               return response()->json([
                   'statue'=>false,
                   'msg'=>'Not Found',
               ]);
           }

       }catch(\Exception $ex){
           return $ex;
           return response()->json([
               'statue'=>false,
               'msg'=>'There Is Error',
           ]);
       }

    }

        public function change_statue($lang_id){
                $lang= Lang::find($lang_id);
                if(isset($lang) && $lang !=null){
                   $statue=$lang->statue==1 ? 0 : 1 ;
                    $lang->update(['statue'=>$statue]);
                    return redirect(route('available_langs'))->with('success','Langs ia '. $lang->getStatue());
                }
            return redirect(route('avalibale_langs'))->with('error','Not Found');
        }
}

