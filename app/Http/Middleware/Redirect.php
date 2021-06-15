<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Redirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

       // Auth::guard('store')->check()
          $admin=Auth::guard('admin')->user();
        if(Auth::guard('admin')->check()){

            return redirect(route('store.dashboard'));

        }
        return $next($request);
    }
}
