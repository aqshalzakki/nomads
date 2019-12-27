<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];
    
    public function travel_package()
    {
    	return $this->belongsTo(TravelPackage::class);
    }

    public function createGallery(array $data)
    {
    	$data['image'] = $data['image']->store('travel-package', 'public');
    	Gallery::create($data);
    }

    public function updateGallery(array $data)
    {
        // store the image
        $data['image'] = $data['image']->store('travel-package', 'public');

        // then delete the previous image from storage directory
        unlink(storage_path("app\public\\" . $this->image));   

        // update the data 
        $this->update($data);
    }
}
