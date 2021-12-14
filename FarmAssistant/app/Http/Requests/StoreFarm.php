<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFarm extends FormRequest
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
            'name' => 'required',
            'street'=> 'required',
            'street_number' => 'required',
            'postal_code' => 'required|size:6',
            'city' => 'required',
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
            'name.required' => 'Nazwa gospdarstwa jest wymagana',
            'street.required' => 'Ulica jest wymagana',
            'street_number.required' => 'Numer domu jest wymagany',
            'postal_code.required' => 'Kod pocztowy jest wymagany',
            'postal_code.size' => 'Kod pocztowy ma niewłaściwy format',
            'city.required' => 'Miejscowość jest wymagana',
            
        ];
    }
}
