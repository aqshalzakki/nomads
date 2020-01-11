<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAndProfileRequest extends FormRequest
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
        $userId = auth()->id();

        $inGenders = Rule::in(['Laki-laki', 'Perempuan', 'Lainnya']);

        return [
            // user
            'username'      => ['required', 'alpha_num', 'between:4,11', Rule::unique('users')->ignore($userId)],
            'email'         => ['email', Rule::unique('users')->ignore($userId)],

            // profile
            'image'         => ['image', 'max:10000'], // in kiloBytes 
            'date_of_birth' => ['required', 'date'],
            'gender'        => ['required', $inGenders],
            'phone_number'  => ['numeric', 'min:7', Rule::unique('profiles')->ignore($userId, 'user_id')]
        ];
    }
}
