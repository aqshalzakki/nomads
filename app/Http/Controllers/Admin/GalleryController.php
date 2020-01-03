<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\GalleryValidation;
use App\Http\Controllers\Controller;

use App\Repositories\GalleryRepository;
use App\Gallery;
use App\TravelPackage;

class GalleryController extends Controller
{
    /**
     * create an instance of gallery repository
     *
     * @return App\TravelPackage
     * @author aqshalzakki
     */
    protected $gallery;
    public function __construct(GalleryRepository $gallery)
    {
        $this->gallery = $gallery;
    }

    public function index()
    {
        $galleries = $this->gallery
                          ->getWith(['travel_package']);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create', [
        	'travel_packages' => TravelPackage::all()
        ]);
    }

    public function store(GalleryValidation $gallery)
    {
    	$this->gallery->createNew($gallery);

        return redirect()->route('admin.galleries.index')->withMessage('A new gallery has been added!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', [
            'gallery'         => $gallery,
            'travel_packages' => TravelPackage::all()
        ]);
    }

    public function update(GalleryValidation $request, $id)
    {
        $this->gallery->update($request, $id);

        return redirect()->route('admin.galleries.index')->withMessage('Gallery travel has been updated!');
    }

    public function destroy($id)
    {
        $this->gallery->destroy($id);
        return redirect()->route('admin.galleries.index')->withMessage('Image has been deleted!');
    }   
}

