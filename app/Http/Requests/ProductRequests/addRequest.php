<?php

namespace App\Http\Requests\ProductRequests;

use App\Type;
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
            'name' => ['required', 'unique:products', 'string', 'min:3', 'max:200'],
            'type_id' => 'required|numeric|exists:'.(new Type)->getTable().',id',
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
            'name.unique' => 'Name cannot be a duplicate!',
            'name.min' => 'Name cannot be less than 3 characters',
            'name.max' => 'You have exceeded the limit of characters!',

            'type_id.required' => 'A type id is required!',
            'type.numeric' => 'Type id has to be a number!',
            'type.exists' => 'This id has been deleted, therefore does not exist',

            'price' => 'A price is required for the product',
            'price.numeric' => 'Price field mm=ust be a number!'
        ];
    }
}
