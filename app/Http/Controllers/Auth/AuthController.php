<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Traits\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidRegister;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  use Helper;
  public function register(){
      return view('auth.register');
  }
    public function store(ValidRegister $request){

      try{
       $image=$this->setPhoto($request->image,$request->name,'user/images');
       $data=$request->except('image');
       $data['image']=$image;
            User::create($data);
            return redirect(url('register'))->with('success','User Created Done');
      }catch(\Exception $ex){
      return $ex;
      }
    }

    public function authenticate(Request $request){

        $data_admin=$request->except('_token');
        // return $data_admin['password'];
        if(!empty($data_admin)){
            if(Auth::guard('admin')->attempt(['email'=>$data_admin['email'],'password'=>$data_admin['password']])){
                return redirect(route('dashboard'));
            }elseif(Auth::attempt(['email'=>$data_admin['email'],'password'=>$data_admin['password']])){
                return redirect(route('home'));
            }
            return back()->with('errors','email or password is false');
        }

    }

    // public function login(Request $request){
    //     return $request;
    // }
}
