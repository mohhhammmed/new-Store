<?php

namespace App\Http\Controllers\store\Admin\Langs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Maincategory;

use Auth;
class LangControll extends Controller
{


    public function add_lang(){
        return view('admin.langs.add_lang');
    }
    public function store_lang(validLang $req){
        $statue=$req->statue;
        $data=$req->except('_token');
        try{
            Lang::create([
                'abbr'=>$data['abbr'],
                'name'=>$data['name'],
                'direction'=>$data['direction'],
                'action'=>$statue[0]
            ]);
            return redirect(route('addLang'))->with('success','تم اضافه اللغه بنجاح');
        }catch(\Exception $ex){
            return redirect(route('addLang'))->with('error','هناك خطا ما');
        }
    }
    public function available_langs(){
        $langs= Lang::data();
        return view('admin.langs.available_langs',compact('langs',$langs));
    }


    public function del_lang(Lang $lang_id){
        $lang_id->delete();
        return redirect(route('available_langs'))->with('success','Deleted Done');

    }


    public function form_edit_lang($lang_id){
        $data_lang=Lang::data()->find($lang_id);
        return view('admin.langs.add_lang',compact('data_lang',$data_lang));
    }

    public function edit_lang(ValidLang $request,$lang_id){
       // return $request;
       try{
        $action=$request->statue[0];
        $data_lang=Lang::data()->find($lang_id);
        $data_lang->update([
            'name'=>$request->name,
            'abbr'=>$request->abbr,
            'action'=>$action,
            'direction'=>$request->direction
        ]);
        return redirect(route('available_langs'))->with('success','Updated Done');
       }catch(\Exception $ex){
        return redirect(route('available_langs'))->with('error','There is proplem');
       }

    }
}

