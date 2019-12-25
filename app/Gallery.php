<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    public function travel_package()
    {
    	return $this->belongsTo(TravelPackage::class);
    }
}
