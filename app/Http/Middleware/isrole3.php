<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isrole3
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
        if(Auth::check() && (Auth::user()->index=='3'||Auth::user()->index=='2'))
        return $next($request);
        else
        abort(404);
    }
}
