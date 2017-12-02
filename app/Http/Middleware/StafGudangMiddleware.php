<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class StafGudangMiddleware
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
        if(Auth::user()->jabatan == 'Staf Gudang' || Auth::user()->jabatan == 'Admin' || Auth::user()->role == 'Super Admin')
            return $next($request);
        else return Redirect::back()->withErrors(['403 - FORBIDDEN!']);
    }
}
