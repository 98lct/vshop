<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class index_1
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
       
            $user = Auth::user();
            // nếu level =1 (admin), status = 1 (actived) thì cho qua.
            if ($user->index != '1' )
            {
                return $next($request);
            }
            else
                abort(404);
       
    }
}
