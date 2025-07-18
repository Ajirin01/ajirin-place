<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OrderAuth
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
                $request->user()->role == 'asaba order manager' || 
                $request->user()->role == 'shop assist' || 
                $request->user()->role == 'minna order manager'){
                return $next($request);
            }else{
                return redirect()->route('admin-login')->with('error', 'Access denied!');
            }
        }else{
            return redirect()->route('admin-login')->with('error', 'Please login!');
        }
    }
}
