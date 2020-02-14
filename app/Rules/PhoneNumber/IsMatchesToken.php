<?php

namespace App\Rules\PhoneNumber;

use Illuminate\Contracts\Validation\Rule;

class IsMatchesToken implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $token = implode('', $value);
        return (int) $token === (int) auth()->user()->sms_token->token;
    }

    public function message()
    {
        return 'The given magic number is invalid!';
    }
}
