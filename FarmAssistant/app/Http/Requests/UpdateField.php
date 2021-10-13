<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateField extends FormRequest
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
            'field_name' => 'required|max:255',
            //'parcel_number' => 'required_with:field_name|string|max:255',
            //'parcel_area' => 'required_with:field_name|numeric|min:0.01',
            'crops' => 'required'
        ];
    }
}
