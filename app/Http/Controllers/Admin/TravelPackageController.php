<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\TravelPackage;

use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    /**
     * create an instance of travel package model
     *
     * @return App\TravelPackage
     * @author aqshalzakki
     */
    protected $travel_package;
    public function __construct()
    {
        $this->travel_package = new TravelPackage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travelPackages = $this->travel_package->paginate(5);
        return view('admin.travel-packages.index', compact('travelPackages') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.travel-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPackageRequest $request)
    {
        $this->travel_package->createNewTravelPackage($request->toArray());

        return redirect()->route('admin.travel-packages.index')->withMessage("{$request->title} has been added successfully!");
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return view('user.travel-package.detail', compact('travelPackage', 'transaction'));
    }

    public function edit(TravelPackage $travelPackage)
    {
        return view('admin.travel-packages.edit', [
            'travelPackage' => $travelPackage
            ]);
    }

    public function update(TravelPackageRequest $request, TravelPackage $travelPackage)
    {   
        $travelPackage->updateTravelPackage($request->toArray());
        
        return redirect()->route('admin.travel-packages.index')->withMessage("{$request['title']} has been updated!");
    }

    public function destroy(TravelPackage $travelPackage)
    {
        $travelPackage->delete();

        return redirect()->route('admin.travel-packages.index')->withMessage("$travelPackage->title has been deleted!");
    }
}
