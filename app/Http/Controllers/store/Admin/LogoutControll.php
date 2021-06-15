<?php

namespace App\Http\Controllers\store\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Admin;
use App\Models\Maincategory;
use Mail;
use Auth;
class LogoutControll extends Controller
{
  public function mm(){
  $emails= Admin::where('email','mf75@gmail.com')->first();

      Mail::to($emails->email)->send(new \App\Mail\StoreMail($emails));

}

    public function logout(){
         $user=Auth::guard('admin')->user();
           Auth::guard('admin')->logout($user);
           return redirect(route('login'));
    }
}

