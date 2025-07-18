<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin.Users.users-dashboard',['users'=> $users]);
    }

    public function create()
    {
        return view('Admin.Users.add-user');
    }

    public function store(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['role'] = $request->role;
        $data['email'] = $request->email;

        if($request->password != $request->password_confirmation){
            return redirect()->back()->with('error','Error, Passwords do not match!');
        }else{
            $data['password'] = Hash::make($request->password);
            // return response()->json(Auth::attempt(['email'=>$request->email,'password'=>$request->password]));
            $user = User::where('email',$request->email)->orWhere('name',$request->name)->first();
            // return response()->json($user == null);
            if($user != null){
                return redirect()->back()->with('error', 'Error! Staff '.$request->name.' Already Exit');
            }else{
                $create_user = User::create($data);
                if($create_user){
                    return redirect()->back()->with('msg','Success! Staff '.$request->name.' created!');
                }
            }
            
        }
        // return response()->json($request->all());
        // User::create($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('Admin.Users.edit-user',['user'=> $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect()->back()->with('msg','User Record Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('msg', 'Staff Record Deleted');
    }
}
