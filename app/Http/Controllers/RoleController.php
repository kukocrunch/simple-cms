<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.authorization.roles.index', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        try {
            Role::create([
                'name' => Str::ucfirst($request->name),
                'slug' => Str::slug($request->name, '-')
            ]);      
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                Session::flash('danger-message', "Role ".Str::slug($request->name)." already exist!");
                Session::flash('exist-highlight', Str::slug($request->name));
                return back();
            }
        }

        Session::flash('success-message', "Role ".Str::slug($request->name)." was created.");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.authorization.roles.edit', 
        ['role' => $role,
         'permissions' => Permission::all() ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role->name = Str::ucfirst($request->name);
        $role->slug = Str::slug($request->name, '-');

        if($role->isClean())
        {
            Session::flash('danger-message', "Nothing has been updated");
            return back();
        }

        else{
            $role->save();

            Session::flash('success-message', "Role updated");
            return redirect(route('roles.index'));    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        Session::flash('danger-message', "The role was removed.");
        return back();
    }


    public function attachPermission(Role $role)
    {
        $permission_id = request('permission');
        $role->permissions()->attach($permission_id);
        Session::flash('success-message', "Permission was attached ". Permission::find($permission_id)->name);
        return back();

    }

    public function detachPermission(Role $role)
    {
        $permission_id = request('permission');
        $role->permissions()->detach($permission_id);
        Session::flash('danger-message', "Permission was detached : " . Permission::find($permission_id)->name);
        return back();
    }




}
