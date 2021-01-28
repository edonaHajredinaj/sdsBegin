<?php

namespace App\Http\Requests\SaleRequests;

use App\Product;
use App\SaleProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateRequest extends FormRequest
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
            'id' => 'required|numeric|exists:'. (new SaleProduct)->getTable().',id,deleted_at,NULL',
            'product_id'  => 'required|numeric|exists:'.(new Product)->getTable().',id,deleted_at,NULL',
            'quantity' => 'required|min:1|numeric',
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
   
    }

    public function messages() {
        return [
            'id.required' => 'Sale id is required',
            'id.numeric' => 'Id must be numeric',
            'id.exists' => 'Id does not exist!',

            'product_id.required' => 'A product id is required!',
            'product_id.numeric' => 'Product id must be a number',
            'product_id.exists' => 'Product id has been deleted!',

            'quantity.required' => 'Id of quantity is required!',
            'quantity.numeric' => 'Quantity should be numeric!',
            'quantity.min' => 'Error: Sales cannot be lower than 1!',
        ];
    }
}
