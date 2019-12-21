<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // if user role is admin  
        if (Auth::user() && Auth::user()->role()->name == "ADMIN")
        {
            return $next($request);
        }
        return \redirect()->route('home');
    }
}
