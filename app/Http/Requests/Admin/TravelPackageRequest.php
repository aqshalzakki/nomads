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
            'title'             => ['required', 'max:40'],
            'location'          => ['required', 'max:40'],
            'about'             => ['required', 'max:191'],
            'featured_event'    => ['required', 'max:60'],
            'language'          => ['required', 'max:20'],
            'foods'             => ['required', 'max:30'],
            'departure_date'    => ['required', 'date'],
            'duration'          => ['required', 'max:10'],
            'type'              => ['required', 'max:15'],
            'category_id'       => ['required', 'exists:categories,id'],
            'price'             => ['required', 'integer'],
            'add_more'          => '',
        ];
    }
}
