<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TravelPackage; 

class TravelPackageController extends Controller
{
	public $travel_package;

	public function __construct(TravelPackage $tp)
	{
		$this->travel_package = $tp;
	}

    public function index()
    {
    	$travelPackages = $this->travel_package->with('galleries')->paginate(9);
    	
    	return view('user.travel-packages.index', compact('travelPackages'));
    }

    public function show($slug)
    {
        $travelPackage = $this->travel_package
                              ->with(['galleries'])
                              ->where('slug', $slug)
                              ->firstOrFail();

        $transaction = $travelPackage->transactions()
                                     ->where('user_id', auth()->id())
                                     ->where('transaction_status_id', 1)
                                     ->with(['details'])
                                     ->first();

        return view('user.travel-packages.detail', compact('travelPackage', 'transaction'));
    }
}
