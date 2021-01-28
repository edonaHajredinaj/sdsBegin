<?php

namespace App\Http\Requests\TypeRequests;

use App\Type;
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
            'id' => 'required|numeric|exists:'.(new Type)->getTable().',id',
            'type' => 'required|string|unique:types|min:3|max:200'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
   
    }

    public function messages()
    {
        return [
            'id.required' => 'An id is required',
            'id.numeric' => 'Id should be a number',
            'id.exists' => 'Id does not exist',

            'type.required' => 'A type is required!',
            'type.string' => 'Type has to be within a-z range!',
            'type.unique' => 'Type cannot be a duplicate!',
        ];
    }
}
