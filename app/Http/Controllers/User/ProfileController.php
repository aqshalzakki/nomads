<?php

namespace App\Http\Controllers\User;

use App\Profile;
use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAndProfileRequest as UserRequest;
use App\Http\Requests\PhoneNumber\TokenRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return request()->isJson() ? view('user.profiles.card')
                                   : view('user.profiles.index');
    }

    public function update(UserRequest $request, Profile $profile)
    {
        $user = $profile->user;

        // old email and old phone number
        $oldEmail       = $user->email;
        $oldPhoneNumber = $profile->phone_number;

        // Prepare for data
        $dataProfile = $request->only(['date_of_birth', 'gender', 'phone_number']);
        $dataProfile['image'] = $profile->handleUploadedImage();

        // update user and profile 
        $profile->update($dataProfile);
        $user->update($request->only([
            'name', 'email'
        ]));

        $profile->handleUpdatedPhoneNumber($oldPhoneNumber);
        $isUpdatedEmail = $user->handleUpdatedEmail($oldEmail);
        
        if ($request->isJson())
        {
            return $isUpdatedEmail ? [
                            'title'         => 'Email Sent!',
                            'emailMessage'  => 'Kindly check your inbox in order to verify the account.',
                            'message'       => 'Profil anda berhasil diperbarui!',
                            'status'        => 204 
                          ]
                        : ['status' => 204, 'message' => 'Profil anda telah diperbarui!'];
        }
        
        return back()->withMessage('Profil anda berhasil diperbarui!'); 

    }

    public function verifyToken(TokenRequest $request, User $user)
    {
        $user->profile->update(['verified_at' => now()]);
        $user->sms_token()->where('user_id', $user->id)->delete();

        
        return $request->isJson() ? ['status' => 204, 'message' => 'Phone number has been verified!']
                                  : back()->withMessage('Phone number has been verified!');
    }
}
