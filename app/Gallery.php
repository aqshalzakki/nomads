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
}
