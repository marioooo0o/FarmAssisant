<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePractise extends FormRequest
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
        //dd($request);
        return [
            'practise_name' => 'required|max:255',
            'fields.*' => 'required|distinct',
            'protectionproduct.*.name' => 'required|distinct',
            'protectionproduct.*.quantity' => 'required|min:0.01|numeric', 
            'water' => 'required|min:1|numeric',
            'start' => 'required|',
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
            'practise_name.required' => 'Nazwa zabiegu jest wymagana',
            'start.required' => 'Data zabiegu jest wymagana',
            'fields.*.distinct' => 'Pola nie mogą się powtarzać',
            'protectionproduct.*.name.required' => 'Nazwa środka :value jest wymagana',
            'protectionproduct.*.name.distinct' => 'Nie możesz kilka  :value razy wybrać ten sam środek',
            'protectionproduct.*.quantity.required' => 'Ilość środka jest wymagana',
        ];
    }
}
