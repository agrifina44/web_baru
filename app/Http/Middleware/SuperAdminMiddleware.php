<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class SuperAdminMiddleware
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
        // dd();
        if(Auth::user()->jabatan == 'Super Admin')
            return $next($request);
        else return Redirect::back()->withErrors(['403 - FORBIDDEN!']);
    }
}
