<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;

use App\TravelPackage;
use App\Category;

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
    public function __construct(TravelPackage $travelPackage)
    {
        $this->travel_package = $travelPackage;
    }

    public function index()
    {
        $travelPackages = $this->travel_package->paginate(5);
        return view('admin.travel-packages.index', compact('travelPackages') );
    }

    public function create()
    {
        return view('admin.travel-packages.create');
    }

    public function store(TravelPackageRequest $request)
    {
        $this->travel_package->createNewTravelPackage($request->except('add_more'));

        return ($request->add_more) ? back()->withMessage("{$request->title} has been added!")
                                    : redirect()->route('admin.travel-packages.index')->withMessage("{$request->title} has been added!");
    }
    
    public function show()
    {
        abort(404);
    }

    public function edit(TravelPackage $travelPackage)
    {
        return view('admin.travel-packages.edit', compact('travelPackage'));
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
