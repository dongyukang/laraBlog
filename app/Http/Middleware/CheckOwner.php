<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckOwner
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
        if(checkSingleRole('owner') == false) {
            //User is not an owner
            Session::flash('flash_message','You don\'t have permission to do that!'); //Notify user
            return redirect('/articles');
        }
        return $next($request);
    }
}
