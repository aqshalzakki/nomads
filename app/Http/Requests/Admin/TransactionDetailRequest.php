<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $unique = Rule::unique('transaction_details')->where(function($query){
            return $query->where('deleted_at', null)
                         ->where('transaction_id', last(explode('/', url()->current())));  
        });
        $exists = Rule::exists('users')->where(function($query){
            return $query->where('role_id', 1)
                         ->whereNotNull('email_verified_at');
        });
        return [
            'username'      => ['required', 'string', $exists, $unique],
            'nationality'   => ['required', 'string', 'size:2'],
            'is_visa'       => ['required', 'boolean'],
            'doe_passport'  => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'username.unique'         => "This member is already added to this travel package!",
            'username.required'       => 'Username is required!',
            'username.exists'         => 'This member is not registered / verified to our application!',
            'nationality.required'    => 'Nationality?',
            'is_visa.required'        => 'You forgot your visa?',
            'is_visa.boolean'         => 'Your visa is invalid!',
            'doe_passport.required'   => 'Please input your doe passport!',
            'doe_passport.date'       => 'Your doe passport format date is invalid'  
        ];
    }
}
