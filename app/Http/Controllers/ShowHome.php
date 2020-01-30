<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShowHome extends Controller
{
    public function __invoke()
    {
        $travelPackages = Cache::remember('travelPackages', now()->addMonths(1), function() {
            return \App\TravelPackage::with(['transactions', 'galleries'])->take(4)->get();
        });

        return view('user.home', compact('travelPackages'));
    }
}
