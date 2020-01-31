<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;    

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    /**
     * create a new travel package
     *
     * @return object
     * @author aqshalzakki
     **/
    public function createNewTravelPackage(array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        return TravelPackage::create($data);
    }

    /**
     * update a travel package
     *
     * @return void
     * @author 
     **/
    public function updateTravelPackage(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        $this->update($data);
    }

    public function galleries()
    {
    	return $this->hasMany(Gallery::class);
    }

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

    public function hasImage()
    {
        $image = $this->galleries->first()->image ?? null;
        return $image ? imageStoragePath($image) : null;
    }
}
