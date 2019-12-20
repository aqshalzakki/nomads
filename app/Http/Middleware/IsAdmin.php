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
        // jika sudah login, dan rolenya admin 
        if (Auth::user() && Auth::user()->role() == "ADMIN")
        {
            return $next($request);
        }
        return \redirect()->route('home');
    }
}
