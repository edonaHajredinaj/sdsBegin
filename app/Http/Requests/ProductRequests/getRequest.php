<?php

namespace App\Http\Requests\ProductRequests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class getRequest extends FormRequest
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
            'id' => 'bail|required|numeric|exists:'.(new Product)->getTable().',id,deleted_at,NULL'
           //Rule::exists('products', 'id')->whereNull('deleted_at')' //dis doesnt werk werk werk
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages()
    {
        return [
            'id.required' => 'Id is required',
            'id.numeric' => 'Id should be a number',
            'id.exists' => 'Id does not exist'
        ];
    }
}
