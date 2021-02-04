<?php

namespace App\Http\Requests\StockRequests;

use App\Stock;
use App\Product;
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
            'id' => 'bail|required|numeric|exists:'.(new Stock)->getTable().',id,deleted_at,NULL',
            'product_id'  => 'bail|required|numeric|exists:'.(new Product)->getTable().',id,deleted_at,NULL',
            'quantity' => 'required|numeric|min:0',
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages() 
    {
        return [
            'id.required' => 'Stock id is required',
            'id.numeric' => 'Id must be numeric',
            'id.exists' => 'Id has been deleted!',

            'product_id.required' => 'A product id is required!',
           
            'product_id.numeric' => 'Product id must be a number!',
            'product_id.exists' => 'This id does not exist in Product',

            'quantity.required' => 'Quantity of product is required',
            'quantity.numeric' => 'Quantity must be an integer!',
            'quantity.min' => 'Quantity cannot be lower than 0',
        ];
    }
}
