<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
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
        //If user is a user...
        if( auth::guard('web')->check() ) {
            return $next($request);
        }
        
        return redirect('login');
    }
}

//If user is admin...
//if( auth::guard('admin')->check() ) {
//    return $next($request);
//}