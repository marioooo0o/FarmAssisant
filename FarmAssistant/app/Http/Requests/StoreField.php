<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreField extends FormRequest
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
            'parcel_numbers.*.name' => 'required|string|max:255',
            'parcel_numbers.*.parcel_area' => 'required|numeric|min:0.01',
            'crops' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'field_name.required' => 'Nazwa pola jest wymagana',
            'crops.required' => 'Wymagany jest wybór uprawy',
            'parcel_numbers.*.name.required' => 'Numer działki jest wymagany jako ciąg znaków',
            'parcel_numbers.*.parcel_area.min' =>'Powierzchnia musi być większa od 0.01 ha' ,
            
        ];
    }
}
