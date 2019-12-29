<?php

namespace App\Http\Controllers;

use App\TravelPackage;

use Illuminate\Http\Request;

class ShowHome extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('user.home', [
            'travelPackages' => TravelPackage::with(['galleries'])->get()
        ]);
    }
}
