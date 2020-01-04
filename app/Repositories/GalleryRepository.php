<?php

namespace App\Repositories;

use App\Gallery;
use Intervention\Image\Facades\Image;

class GalleryRepository{

	protected $gallery;

	public function __construct(Gallery $gallery)
	{
		$this->gallery = $gallery;
	}

	public function getPaginateWith($amount, $relation)
	{
		return $this->gallery
					->with($relation)
					->orderBy('travel_package_id', 'ASC')
					->paginate($amount);
	}

	public function createNew(object $data)
    {
    	$data = $data->toArray();

        // store the image
    	$data['image'] = $data['image']->store('travel-package', 'public');
    	
        // resize the image
        Image::make(public_path("storage/{$data['image']}"))->fit(752, 508)->save();

        $this->gallery->create($data);
    }

    public function update(object $data, $id)
    {
    	$gallery = $this->gallery->find($id); 

    	$data = $data->toArray();

        // store the image
        $data['image'] = $data['image']->store('travel-package', 'public');

        // resize the image
        Image::make(public_path("storage/{$data['image']}"))->fit(752, 508)->save();
        
        // then delete the previous image from storage directory
        unlink(storage_path("app\public\\" . $gallery->image));   

        // update the data 
        $gallery->update($data);
    }


    public function destroy($id)
    {
    	$this->gallery->destroy($id);
    }
}