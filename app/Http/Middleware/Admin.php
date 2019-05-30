<?php

namespace App\Http\Middleware;

use Closure;
use Auth;//忘れない
class Admin
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
        if(Auth::user()->user_type == 'admin'){//もしadminだったらそのままプロセスが続く
            return $next($request);
        }
        return redirect()->to('/')->with('message', 'Permission denied !');//もし違かったら進まない url についてregisterController.phpを参照

    }
}
