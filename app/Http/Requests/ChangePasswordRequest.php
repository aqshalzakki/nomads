<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsPasswordMatches;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', new IsPasswordMatches ],
            'new_password'     => ['required', 'different:current_password', 'confirmed', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Current password cannot be empty!',
            'new_password.required'     => 'New password cannot be empty!',
            'new_password.confirmed'    => 'Password didn\'t match you bit*h!',
            'new_password.min'          => 'Password must be at least :min characters!',
            'new_password.different'    => 'New password cannot be the same as current password!',
        ];
    }
}
