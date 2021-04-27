<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::all()->except(Auth::user()->id);
        return view('admin.users.index', ['users'=>$users]);
    }

    public function show(User $user)
    {
        return view('admin.users.profile', 
                    ['user' => $user,
                    'roles' => Role::all()]);
    }

    public function update(User $user, Request $request)
    {
        $validation = ['username' => 'required|string|max:255|alpha_dash',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'avatar' => 'mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100'];

        if($request->password || $request->password_confirmation){
            $validation['password'] = 'confirmed|min:6';
        }

        $inputs = $request->validate($validation);

    
        if($request->avatar){
            $inputs['avatar'] = $request->avatar->store('images');
        }

        $user->update($inputs);


        Session::flash('message', 'Profile successfully updated');
        return back();
    }


    public function destroy(User $user)
    {
        //Cannot remove self
        if(Auth::user()->id === $user->id){
            Session::flash('user-error', "Action not allowed");
            return back();
        }

        $user->delete();
        Session::flash('user-deleted', "User was removed");

        return back();
    }

    public function attachRole(User $user)
    {
        $role_id = request('role');
        // dd(request('role'));
        $user->roles()->attach($role_id);
        // dd(Role::find(request('role'))->name);
        Session::flash('message', "User attached to role ". Role::find($role_id)->name);
        return back();

    }

    public function detachRole(User $user)
    {
        $role_id = request('role');
        $user->roles()->detach($role_id);

        Session::flash('message', "User was detached from role : " . Role::find($role_id)->name);
        return back();
    }
}
