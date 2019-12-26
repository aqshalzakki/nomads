<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
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
    		'travel_package_id'	=> 'required',
    		'image' 			=> ['required','image'],
    	]);
    	$data['image'] = $data['image']->store('travel-package', 'public');

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->withMessage('A new image has been added!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', [
            'gallery'         => $gallery,
            'travel_packages' => TravelPackage::all()
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'travel_package_id' => 'required',
            'image'             => 'image',
        ]);

        // if admin choose to change the image 
        if ($request->has('image'))
        {
            // store the image
            $data['image'] = $data['image']->store('travel-package', 'public');

            // then delete the previous image from storage directory
            unlink(storage_path("app\public\\" . $gallery->image));   
        }

        // update the data 
        $gallery->update($data);
        
        // last thing is redirect to index page.. of course
        return redirect()->route('admin.gallery.index')->withMessage('Gallery travel has been updated!');
    }

    public function destroy($id)
    {
        Gallery::destroy($id);
        return redirect()->route('admin.gallery.index')->withMessage('Image has been deleted!');
    }   
}

