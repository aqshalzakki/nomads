<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
    // All relationship
    
    public function galleries()
    {
    	return $this->hasMany(Gallery::class);
    }

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // ----------------- //

    public function hasImage()
    {
        return $this->galleries->count() >= 1;
    }

    public function firstImageUrl()
    {
        return Storage::url($this->galleries->first()->image);
    }

    public function getByKeyword($keyword)
    {
        return $this->with(['galleries'])
             ->where('title', 'like', "%$keyword%")
             ->orWhere('location', 'like', "%$keyword%")
             ->orWhere('featured_event', 'like', "%$keyword%")   
             ->orWhere('language', 'like', "%$keyword%")
             ->orWhere('departure_date', 'like', "%$keyword%")
             ->orWhere('type', 'like', "%$keyword%")
             ->orWhere('price', 'like', "%$keyword%")
             ->paginate(9);
    }
}
