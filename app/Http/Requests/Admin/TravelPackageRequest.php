<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TravelPackageRequest extends FormRequest
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
            'title'             => ['required', 'max:120'],
            'location'          => ['required', 'max:40'],
            'about'             => 'required',
            'featured_event'    => ['required', 'max:120'],
            'language'          => ['required', 'max:50'],
            'foods'             => ['required', 'max:60'],
            'departure_date'    => ['required', 'date'],
            'duration'          => ['required', 'max:40'],
            'type'              => ['required', 'max:40'],
            'price'             => ['required', 'integer']
        ];
    }
}
