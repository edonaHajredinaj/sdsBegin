<?php

namespace App\Http\Requests\SaleRequests;

use App\SaleProduct;
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
            'id' => 'bail|required|numeric|exists:'. (new SaleProduct)->getTable().',id,deleted_at,NULL'
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages() 
    {
        return [
            'id.required' => 'Sale id is required',
            'id.numeric' => 'Id must be numeric',
            'id.exists' => 'Id does not exist!',
        ];
    }
}
