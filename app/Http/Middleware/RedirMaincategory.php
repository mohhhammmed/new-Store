<?php

namespace App\Http\Middleware;

use App\Models\Maincategory;
use Closure;
use Illuminate\Http\Request;

class RedirMaincategory
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
        $maincategories=Maincategory::all();
        if($maincategories->count() == null){
            return redirect(route('admin.addCategories'));
        }
        return $next($request);
    }
}
