<?php

namespace App\Http\Controllers;

class ShowHome extends Controller
{
    public function __invoke()
    {
        $travelPackages = \App\TravelPackage::with(['transactions', 'galleries'])->take(4)->get();

        return view('user.home', compact('travelPackages'));
    }
}
