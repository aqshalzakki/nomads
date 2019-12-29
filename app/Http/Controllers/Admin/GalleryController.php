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
    /**
     * create an empty instance of gallery model
     *
     * @return App\TravelPackage
     * @author aqshalzakki
     */
    protected $gallery;
    public function __construct()
    {
        $this->gallery = new Gallery;
    }

    public function index()
    {
        $galleries = Gallery::with(['travel_package'])
                            ->orderBy('travel_package_id', 'asc')
                            ->get();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create', [
        	'travel_packages' => TravelPackage::all()
        ]);
    }

    public function store(GalleryRequest $request)
    {
    	$this->gallery->createGallery($request->toArray());

        return redirect()->route('admin.galleries.index')->withMessage('A new gallery has been added!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', [
            'gallery'         => $gallery,
            'travel_packages' => TravelPackage::all()
        ]);
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $gallery->updateGallery($request->toArray());

        return redirect()->route('admin.galleries.index')->withMessage('Gallery travel has been updated!');
    }

    public function destroy($id)
    {
        $this->gallery->destroyGallery($id);
        return redirect()->route('admin.galleries.index')->withMessage('Image has been deleted!');
    }   
}

