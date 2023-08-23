<?php

namespace App\Http\Middleware;

use Closure;
Use Auth;

class Isadmin
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
        /*if(Auth::user()->roles == 'admin'){
            return $next($request);
        }
        else
            return  abort('404');*/
        if (Auth::check())
        {
            $user = Auth::user();
            // nếu level =1 (admin), status = 1 (actived) thì cho qua.
            if ($user->roles == 'admin' )
            {
                return $next($request);
            }
            else
            {
                //Auth::logout();
                return redirect()->route('Home')->with('message','Đăng Nhập Thành Công');
            }
        } else
            return redirect()->Route('login');
    }
}
