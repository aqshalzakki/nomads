<?php

namespace App\Http\Middleware;

use Closure;

class IsInCart
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
        // if the transaction status is still IN_CART
        if($request->transaction->transaction_status_id == 1){
            return $next($request);
        }
        return abort(403);
    }
}
