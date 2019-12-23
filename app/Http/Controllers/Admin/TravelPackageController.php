<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\TravelPackage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travelPackages = TravelPackage::all();

        return view('admin.travel-package.index', compact('travelPackages') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.travel-package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPackageRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->title);
        
        TravelPackage::create($data);

        return redirect()->route('admin.travel-package.index')->withMessage( "$request->title has been added successfully!");
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($travelPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TravelPackage $travelPackage)
    {
        return view('admin.travel-package.edit', [
            'travelPackage' => $travelPackage
            ]);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(TravelPackageRequest $request, TravelPackage $travelPackage)
        {
            $request = $request->all();
            
            $request['slug'] = Str::slug($request['title']);
            $travelPackage->update($request);
            
            return redirect()->route('admin.travel-package.index')->withMessage("{$request['title']} has been updated!");
        }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TravelPackage $travelPackage)
    {
        $travelPackage->destroy($travelPackage->id);

        return redirect()->route('admin.travel-package.index')->withMessage("$travelPackage->title has been deleted!");
    }
}
