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

        $user = cache()->remember('user' . auth()->id(), now()->addMonths(1), function(){
            return auth()->user();
        });

        return view('user.home', compact('travelPackages', 'user'));
    }
}
