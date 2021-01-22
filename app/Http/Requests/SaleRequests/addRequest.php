<?php

namespace App\Http\Requests\SaleRequests;

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
            'product_id'  => 'required|unique:saleProduct|numeric',
            'quantity' => 'required|numeric'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
   
    }

    public function messages() {
        return [
            'product_id.required' => 'A product id is required!',
            'product_id.unique' => 'The product id cannot be a duplicate!',
            'quantity.required' => 'Id of quantity is required!',
            'quantity.numeric' => 'Quantity should be numeric'
        ];
    }
}
