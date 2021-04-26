<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Session\Middleware\StartSession;

class AuthisAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        // dd(session('user'));
        // dd($request->session()->all());
        if($request->session()->get('level') == 1){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
