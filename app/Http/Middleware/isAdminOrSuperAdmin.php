<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdminOrSuperAdmin
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
		//If user is admin...
		if( auth::guard('admin')->check() || auth::guard('superadmin')->check() ) {
			
            return $next($request);
        }
		
		//If user is not authorised...
		return redirect('');
    }
}
