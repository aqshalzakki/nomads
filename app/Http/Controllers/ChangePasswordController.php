<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest as Request;
use App\Notifications\User\PasswordChangedNotification;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('user.password.edit');
    }

    public function update(Request $request, \App\User $user)
    {
        $user->update([
            'password' => Hash::make($request->input('new_password'))]
        );

        // notify the user
        $user->notify(new PasswordChangedNotification($user));
        
        return back()->withMessage('Your password has been changed!');
    }
}
