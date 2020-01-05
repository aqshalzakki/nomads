<?php

namespace App\Http\Middleware;

use Closure;

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
        if (auth()->user()->role->title === "ADMIN")
        {
            return $next($request);
        }
        return \redirect()->route('home');
    }
}
