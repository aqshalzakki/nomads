<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'      => ['unique:transaction_details,username', 'required', 'string', 'exists:users,username'],
            'nationality'   => ['required', 'string', 'size:2'],
            'is_visa'       => ['required', 'boolean'],
            'doe_passport'  => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'username.unique'         => "You've already registering this member!",
            'username.required'       => 'Username is required!',
            'username.exists'         => 'Username is not registered to our application!',
            'nationality.required'    => 'Your nationalities?',
            'is_visa.required'        => 'You forgot your visa?',
            'is_visa.boolean'         => 'Your visa is invalid!',
            'doe_passport.required'   => 'Please input your doe passport!',
            'doe_passport.date'       => 'Your doe passport format date is invalid'  
        ];
    }
}
