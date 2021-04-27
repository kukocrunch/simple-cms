<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Permission;

class PermissionController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.authorization.permissions.index', ['permissions' => Permission::all()]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        try {
            Permission::create([
                'name' => Str::ucfirst($request->name),
                'slug' => Str::slug($request->name, '-')
            ]);      
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                Session::flash('danger-message', "Permission ".Str::slug($request->name)." already exist!");
                Session::flash('exist-highlight', Str::slug($request->name));
                return back();
            }
        }

        Session::flash('success-message', "Permission ".Str::slug($request->name)." was created.");
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.authorization.permissions.edit', 
        ['permission' => $permission]
        );
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permission->name = Str::ucfirst($request->name);
        $permission->slug = Str::slug($request->name, '-');

        if($permission->isClean())
        {
            Session::flash('danger-message', "Nothing has been updated");
            return back();
        }

        else{
            $permission->save();

            Session::flash('success-message', "Permission updated");
            return redirect(route('permissions.index'));    
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        Session::flash('danger-message', "The permission was removed.");
        return back();
    }




}
