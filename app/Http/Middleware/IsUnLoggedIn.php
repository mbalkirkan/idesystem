<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUnLoggedIn
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $type=Auth::user()->type;
            switch ($type) {
                case 1:
                    return redirect()->route('admin.index');
                case 2:
                    return redirect()->route('supervisor.index');
                case 3:
                    return redirect()->route('user.index');
            }

                } else
            return $next($request);
    }
}
