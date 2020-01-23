<?php

namespace App\Http\Controllers\User;

use App\Profile;
use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAndProfileRequest as UserRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = cache()->remember('user' . auth()->id(), now()->addMonths(1), function(){
            return auth()->user();
        });

        return view('user.profiles.index', compact('user'));
    }

    public function update(UserRequest $request, Profile $profile)
    {
        // User Instance... so i dont have to call it over and over again
        $user = $profile->user;

        // old email
        $oldEmail = $user->email;

        $dataProfile = $request->except(['username', 'email']);
        $dataProfile['image'] = $profile->handleUploadedImage();

        // update profile
        $profile->update($dataProfile);

        // update user
        $user->update($request->only(['username', 'email' ]));

        // set cache
        cache()->put('user' . auth()->id(), $user, now()->addMonths(1));

        return ( $user->handleUpdatedEmail($oldEmail) ) ? redirect('/email/verify')
                                                          ->withMessage($user->emailChangedMessage())
                                                        : back();
    }
}
