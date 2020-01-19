<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * check if user has a gender... or even not
     *
     * @return string
     * @author aqshalzakki
     **/
    public function isGender($gender)
    {
    	return ($this->gender == $gender) ? 'checked' : ''; 
    }

    public function handleUploadedImage()
    {
               
        if ($this->isNewImage()){
            Storage::disk('public')
                   ->delete( imageStoragePath($this->image) );
        }

        // store the image
        return request()->image->storeAs('profiles', $this->user->username . $this->user->id . ".jpg", 'public');
    }

    /**
     * check if current image is not the same as present
     *
     * @return void
     * @author 
     **/
    public function isNewImage()
    {
        return $this->image != 'profiles/default.jpg' ? true : false;
    }
}
