<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Nexmo\Laravel\Facade\Nexmo;

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
        if (request()->has('image')){

            if ($this->isNewImage()){

                // then delete the old image
                Storage::disk('public')
                       ->delete( Storage::url($this->image) );
            }
            
            // store the image
            return request()->image->storeAs('profiles', $this->user->username . $this->user->id . ".jpg", 'public');
        }

        return $this->image; 
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

    public function handleUpdatedPhoneNumber($oldNumber)
    {
        // my phone number : 6288229373493 
        if($this->phone_number != $oldNumber)
        {
            // generate a random number 
            $token = rand(1000,9999);
            
            // delete all the token by user
            auth()->user()->sms_token()->where('user_id', $this->user->id)->delete();
            
            // create new sms token
            auth()->user()->sms_token()->create([
                'token'      => (int) $token,
                'expired_at' => now()->addMinutes(15)
            ]);


            // Send the message
            // Nexmo::message()->send([
            //     'to'   => $this->phone_number,
            //     'from' => env('NEXMO_FROM'),
            //     'text' => 'Kode verifikasi untuk nomor telepon akun nomads anda ' . (int) $token . ' .Jangan bagikan kode ini kepada siapapun.',
            // ]);

            // Update verified at to null
            $this->update(['verified_at' => null]);

            return $this->phone_number;
        }

        return null;
    }

    public function hasVerifiedPhoneNumber()
    {
        return $this->verified_at ?? false;
    }
}
