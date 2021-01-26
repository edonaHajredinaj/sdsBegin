<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class addRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'type_id' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
   
    }

    public function messages()
    {
        return [
            'name.required' => 'A product name is required',
            'name.string' => 'Name of product should only contain letters a-z',

            'type_id.required' => 'A type id is required!',
            'type.numeric' => 'Type id has to be a number!',

            'price' => 'A price is required for the product',
            'price.numeric' => 'Price field mm=ust be a number!'
        ];
    }
}
