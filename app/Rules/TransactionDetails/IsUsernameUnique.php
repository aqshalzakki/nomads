<?php

namespace App\Rules\TransactionDetails;

use Illuminate\Contracts\Validation\Rule;

class IsUsernameUnique implements Rule
{
    public function passes($attribute, $value)
    {
        $transaction_id = last(explode('/', url()->current()));

        return \App\User::whereUsername($value)
                    ->with([
                        'transaction_details' => function($query) use($transaction_id){
                            $query->where('transaction_id', $transaction_id)->where('deleted_at', null);
                    }])->count() == 1 ? true : false;
    }

    public function message()
    {
        return 'This member is already added to this travel package';
    }
}
