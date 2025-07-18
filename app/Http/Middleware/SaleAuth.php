<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SaleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if($request->user()->role == 'admin'|| 
                $request->user()->role == 'retail rep' ||
                $request->user()->role == 'wholesale rep'){
                return $next($request);
            }else{
                return redirect()->route('admin-login');
            }
        }else{
            return redirect()->route('admin-login');
        }
    }
}
