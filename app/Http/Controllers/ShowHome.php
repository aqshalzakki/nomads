<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShowHome extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $travelPackages = Cache::remember('travelPackages', now()->addHours(24), function() {
            return \App\TravelPackage::with(['galleries'])->get();
        });
        return view('user.home', compact('travelPackages'));
    }
}
