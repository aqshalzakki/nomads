<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class IsPasswordMatches implements Rule
{
    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'Your current password is incorrect!';
    }
}
