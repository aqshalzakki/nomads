<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryValidation extends FormRequest
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
            'travel_package_id' => 'required',
            'image'             => ['required', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'image.image'      => 'The file must be an image(jpg, jpeg, png)',
        ];
    }
}
