<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gallery;
use App\TravelPackage;
use App\Http\Requests\Admin\GalleryRequest;

class GalleryController extends Controller
{    
    public function index()
    {
        return view('admin.gallery.index', [
            'galleries' => Gallery::with(['travel_package'])->get()
        ]);
    }

    public function create()
    {
        return view('admin.gallery.create', [
        	'travel_packages' => TravelPackage::all()
        ]);
    }

    public function store(Request $request)
    {
    	$data = $request->validate([
    		'travel_package_id'	=> '',
    		'image' 			=> ['required','image'],
    	]);
    	$data['image'] = $data['image']->store('travel-package', 'public');

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->withMessage('A new image has been added!');
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy($id)
    {
        Gallery::destroy($id);
        return redirect()->route('admin.gallery.index')->withMessage('Image has been deleted!');
    }
}

