<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use Auth;
class HomeController extends Controller
{
    public function home(){
        return view('store.home.index');
    }
    public function adminStore(Request $request){

        $data_admin=$request->except('_token');
       // return $data_admin['password'];
        if(!empty($data_admin)){
            if(Auth::guard('store')->attempt(['email'=>$data_admin['email'],'password'=>$data_admin['password']])){
                return redirect(route('store.dashboard'));
            }
            return back()->with('errors','email or password is false');
        }

    }
    public function dashboard_admin(){
        return view('store.store.dashboard.dashboard');
    }
    public function add_lang(){
        return view('store.store.langs.add_lang');
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
        return Lang::data();
    }
}
