<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use App\Http\Requests\ValidRegister;
use Hash;
use App\Traits\Helper;
use Illuminate\Http\Request;

class ProfileControll extends Controller
{
    use Helper;
    public function profile(){
        $user=Auth::user();
       return view('user.edit_user_profile',compact('user'));

    }
    public function edit(Request $request,User $us){

            //////////////validation//////////
                    $this->valid($request);

     //   return $request->new_email;
      try{
            $user=Auth::user();
            $user=User::find($user->id);

            if(isset($user) && $user!=null){
            if($request->has('image') || $request->has('name')){
               // return $request;
               if($request->has('image')){
                $image=$this->setPhoto($request->image,$request->name,'user/images');
               $data=$request->except('image');
               $data['image']=$image;

               if($data['name']==null){
                $data['name']=$user->name;
               }
               if(file_exists($us->getImage().$user->image) && $user->image !=null){
                    unlink($us->getImage().$user->image);
                   }
               $user->update($data);
               return redirect(route('userProfile'))->with('success','Updated Done');
              }
              $data=$request->all();
              $user->update($data);
               return redirect(route('userProfile'))->with('success','Updated Done');
            }

            if($request->has('new_password') &&$request->new_password==$request->confirm_password){
                $data=$request->except('new_password');
                $data['password']=$request->new_password;
                $user->update($data);
                return redirect(route('userProfile'))->with('success','Updated Done');
             }
             if($request->has('email') && $request->email == $user->email){
              //   return $request->new_email;
                $data=$request->except('email','new_email');

                $data['email']=$request->new_email;
                $user->update($data);
                return redirect(route('userProfile'))->with('success','Updated Done');
             }

             return redirect(route('userProfile'))->with('error','enter data correctly');
          }

      }catch(\Exception $ex){
          return $ex;
        return redirect(route('userProfile'))->with('error','There is Error');
      }


    }

    public function delete($user_id){
        try{
            $user= User::find($user_id);
            if(isset($user) && $user!=null){
                $user->delete();
                return redirect(route('login'));
            }
        }catch(\Exception $ex){
            return $ex;
        }


    }
}
