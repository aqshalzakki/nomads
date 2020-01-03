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

    public function destroyGallery($id)
    {
        $image = $this->find($id)->image;

        // delete the image
        unlink(storage_path("app\public\\" . $image));

        $this->destroy($id);        
    }
}
