<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckNotBanned
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
        //Ensure user is logged in
        if(Auth::guest()) {
            return redirect('/auth/login');
        }

        //Ensure that the user is not banned
        $roles = Auth::user()->roles;
        $valid = true;
        //Loop through roles and check for permission
        foreach($roles as $role) {
            if($role->name == "banned") {
                $valid = false;
            }
        }
        if($valid == false) {
            //User is not an admin or an owner, redirect them
            Session::flash('flash_message','You don\'t have permission to do that!'); //Notify user
            return redirect('/articles');
        }

        return $next($request);
    }

}
