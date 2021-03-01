<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
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
        if (Auth::user()->type == 3)
            return $next($request);
        else
        {
            Auth::logout();
            return redirect()->route('login.index')->with('error', 'Yetkisiz Giriş !');
        }
    }
}
