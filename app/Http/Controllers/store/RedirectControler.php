<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
//use Socialite;
//use Auth;

class RedirectControler extends Controller
{
    public function rdeirectLogin($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function rdeirectLoginCallback($provider,Admin $ad){
        $user = Socialite::driver($provider)->user();
        if(isset($user)){
           $user=$ad->redir($user);
           Auth::guard('admin')->login($user);
           return redirect(route('store.dashboard'));

        }

    }
}
