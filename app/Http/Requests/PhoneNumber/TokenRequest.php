<?php

namespace App\Http\Requests\PhoneNumber;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumber\IsMatchesToken;

class TokenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'digits' => ['required', new IsMatchesToken]
        ];
    }

    public function messages()
    {
        return [
            'digits.required' => 'Magic numbers cannot be empty!',
            'digits'  => 'The given magic number must be a number!'
        ];
    }
}
