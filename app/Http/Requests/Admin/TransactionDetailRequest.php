<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionDetailRequest extends FormRequest
{
    public function authorize()
    {
        // return auth()->user()->role_id == 1;
        return 1;
    }

    public function rules()
    {
        return [
            'email'         => ['required', 'exists:users'],
            'nationality'   => ['required', 'string', 'size:2'],
            'is_visa'       => ['required', 'boolean'],
            'doe_passport'  => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'email.required'          => 'email is required!',
            'email.exists'            => 'This member is not verified to our application!',
            'email.unique'            => 'This member already joined!',
            'nationality.required'    => 'Nationality?',
            'is_visa.required'        => 'You forgot your visa?',
            'is_visa.boolean'         => 'Your visa is invalid!',
            'doe_passport.required'   => 'Please input your doe passport!',
            'doe_passport.date'       => 'Your doe passport format date is invalid'  
        ];
    }
}