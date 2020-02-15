<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TravelPackage;
use App\Transaction;

class ShowDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('admin.dashboard', [
            'countTravelPackages'      => TravelPackage::count(),
            'countTransactions'        => Transaction::count(),
            'countPendingTransactions' => Transaction::where('transaction_status_id', 2)->count(),
            'countSuccessTransactions' => Transaction::where('transaction_status_id', 3)->count(),
        ]);
    }
}
