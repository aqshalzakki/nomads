<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;    

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function galleries()
    {
    	return $this->hasMany(Gallery::class);
    }
}
