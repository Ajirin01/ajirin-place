<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function loginForm(){
        return view('Admin.login');
    }

    public function login(Request $request){
        $user = Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember);
        if($user){
            $branch = $request->branch;
            if(Auth::user()->role != 'admin' && empty($branch)){
                Auth::logout();
                return redirect()->route('admin-login')->with('error', 'login error! Please select branch if you are not admin');
            }else if((Auth::user()->role == 'retail rep' || Auth::user()->role == 'asaba product manager' || Auth::user()->role == 'asaba order manager') && $branch != 'asaba'){
                Auth::logout();
                return redirect()->route('admin-login')->with('error', 'login error! You do not have access to Minna branch');
            }else if((Auth::user()->role == 'wholesale rep' || Auth::user()->role == 'minna product manager' || Auth::user()->role == 'minna order manager' ) && $branch != 'minna'){
                Auth::logout();
                return redirect()->route('admin-login')->with('error', 'login error! You do not have access to Asaba branch');
            }else if(Auth::user()->role == 'admin' || Auth::user()->role == 'asaba product manager' || Auth::user()->role == 'asaba order manager' || Auth::user()->role == 'retail rep' || Auth::user()->role == 'shop assist' || $branch == 'asaba'){
                Session::put('sale_mode', 'retail');
            }else if(Auth::user()->role == 'admin' || Auth::user()->role == 'wholesale rep' || Auth::user()->role == 'minna product manager' || Auth::user()->role == 'minna order manager' || Auth::user()->role == 'shop assist' || $branch == 'minna'){
                Session::put('sale_mode', 'wholesale');
            }

            Session::put('branch', $branch);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', 'login error! check your credential and login again');
        }

        
    }
}
