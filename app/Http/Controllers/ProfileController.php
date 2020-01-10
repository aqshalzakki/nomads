<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Http\Requests\UserAndProfileRequest as UserRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profiles.index');
    }

    public function update(UserRequest $request, Profile $profile)
    {
        // old email
        $oldEmail = $profile->user->email;

        $dataProfile = $request->except(['username', 'email']);
        
        if ($request->has('image')){
            $dataProfile['image'] = $profile->handleUploadedImage();
        }

        // update profile
        $profile->update($dataProfile);

        // update user
        $profile->user->update($request->only([
            'username', 'email'
        ]));

        // if user update an email
        if ($oldEmail != $profile->user->email){
            
            $profile->user->update(['email_verified_at' => null]);
            $profile->user->handleEmailVerification($oldEmail);

            return redirect('/email/verify')->withMessage("We've been sending a link verification to <b>{$profile->user->email}</b> please verify for further action");
        }

        return back();
    }
}
