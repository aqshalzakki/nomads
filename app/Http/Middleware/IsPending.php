<?php

namespace App\Http\Middleware;

use Closure;
use App\Transaction;

class IsPending
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
        $transaction = Transaction::findOrFail($request->id);

        // if the transaction status is pending or in cart
        if ($transaction->transaction_status_id == 1 OR $transaction->transaction_status_id == 2)
        {
            return $next($request);
        }

        return abort(404);
    }
}
