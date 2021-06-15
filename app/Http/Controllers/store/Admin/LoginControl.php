<?php

namespace App\Http\Controllers\store\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Maincategory;

use Auth;
class LoginControl extends Controller
{

    public function adminStore(Request $request){

        $data_admin=$request->except('_token');
       // return $data_admin['password'];
        if(!empty($data_admin)){
            if(Auth::guard('admin')->attempt(['email'=>$data_admin['email'],'password'=>$data_admin['password']])){
                return redirect(route('store.dashboard'));
            }elseif(Auth::attempt(['email'=>$data_admin['email'],'password'=>$data_admin['password']])){
                return 'hello usser';
            }
            return back()->with('errors','email or password is false');
        }

    }

}
