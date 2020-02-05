<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest as Request;
use App\Notifications\User\PasswordChangedNotification;

class UserPasswordController extends Controller
{
    public function edit()
    {
        return request()->isJson() ? view('user.password.card') : view('user.password.edit');
    }

    public function update(Request $request, \App\User $user)
    {
        $user->update([
            'password' => Hash::make($request->input('new_password'))]
        );

        // notify the user
        $user->notify(new PasswordChangedNotification($user));
        
        // put cache
        putUserCache($user);

        return back()->withMessage('Your password has been changed!');
    }

    public function checkPassword()
    {
        $requestPassword = request()->input('currentPassword');
        $userPassword    = auth()->user()->password;

        return (Hash::check($requestPassword, $userPassword )) 
                ? ['status'  => true]
                : ['status'  => false, 'message' => 'Password don\'t match!'];
    }
}
