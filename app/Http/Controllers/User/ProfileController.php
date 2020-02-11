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
        return request()->isJson() ? view('user.profiles.card')
                                   : view('user.profiles.index');
    }

    public function update(UserRequest $request, Profile $profile)
    {
        // User Instance... so i dont have to call it over and over again
        $user = $profile->user;

        // old email
        $oldEmail = $user->email;

        $dataProfile = $request->except(['name', 'email']);
        $dataProfile['image'] = $profile->handleUploadedImage();

        $profile->update($dataProfile);
        $user->update($request->only([
            'name', 'email'
        ]));

        // set cache
        putUserCache($user);

        return ( $user->handleUpdatedEmail($oldEmail) ) ? redirect('/email/verify')
                                                          ->withMessage($user->emailChangedMessage())
                                                        : back()->withMessage('Profil anda telah diperbarui!');
    }
}
