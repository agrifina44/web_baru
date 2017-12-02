<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class StafFinanceMiddleware
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
        if(Auth::user()->jabatan == 'Staf Finance' || Auth::user()->jabatan == 'Admin' || Auth::user()->jabatan == 'Super Admin')
            return $next($request);
        else return Redirect::back()->withErrors(['403 - FORBIDDEN!']);
    }
}
