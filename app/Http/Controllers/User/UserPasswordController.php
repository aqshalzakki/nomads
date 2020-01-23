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
        $user = cache()->get('user');
        return view('user.password.edit', compact('user'));
    }

    public function update(Request $request, \App\User $user)
    {
        $user->update([
            'password' => Hash::make($request->input('new_password'))]
        );

        // notify the user
        $user->notify(new PasswordChangedNotification($user));
        
        // set cache
        cache()->put('user', $user, now()->addMonths(1));

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
