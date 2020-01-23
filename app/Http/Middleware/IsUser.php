<?php

namespace App\Http\Middleware;

use Closure;

class IsUser
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
        $user = cache()->remember('user' . auth()->id(), now()->addMonths(1), function(){
            return auth()->user();
        });
        
        return $user->isRole('USER') ? $next($request) : back();
    }
}
