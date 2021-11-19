<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMagazine extends FormRequest
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
            'addProtectionProduct.*.product_name' => 'required|distinct',
            'addProtectionProduct.*.quantity' => 'required|numeric|min:0.01' 
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
            'addProtectionProduct.*.product_name.required' => 'Nazwa produktu jest wymagana',
            'addProtectionProduct.*.product_name.distinct' => 'Produkt nie może się powtarzać',
            'addProtectionProduct.*.quantity.required' => 'Ilość środka jest wymagana',
        ];
    }
}
