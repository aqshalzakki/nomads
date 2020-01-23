<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShowHome extends Controller
{
    public function __invoke()
    {
        $travelPackages = Cache::remember('travelPackages', now()->addYears(1), function() {
            return \App\TravelPackage::with(['galleries'])->get();
        });

        return view('user.home', compact('travelPackages'));
    }
}
