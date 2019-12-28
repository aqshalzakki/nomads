<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'transaction_status_id' => ['required', 'exists:transaction_statuses,id']
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Transaction status cannot be the same as before!',
            'exists'   => 'Transaction status is invalid!'
        ];
    }
}
