<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        foreach($roles as $role) {
            if($user->userHasRole($role))
                return $next($request);
        }

        Session::flash('message', 'Error: Action not allowed!');
        return redirect()->route('admin.index');
    }
}
