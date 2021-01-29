<?php

namespace App\Http\Requests\StockRequests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class saveRequest extends FormRequest
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
            'product_id'  => 'required|unique:stocks|numeric|exists:'.(new Product)->getTable().',id,deleted_at,NULL',
            'quantity' => 'required|numeric|min:0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages()
    {
        return [
            'product_id.required' => 'A product id is required!',
            'product_id.unique' => 'The product id cannot be a duplicate!',
            'product_id.numeric' => 'Product id must be a number!',
            'product_id.exists' => 'This id does not exist in Product',

            'quantity.required' => 'Quantity of product is required',
            'quantity.numeric' => 'Quantity must be an integer!',
            'quantity.min' => 'Quantity cannot be lower than 0',
        ];
    }
}
