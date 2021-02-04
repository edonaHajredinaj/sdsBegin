<?php

namespace App\Http\Requests\TypeRequests;

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

     // me mujt me bo metod ne kontrollerin e Type. edhe me thirr veq kur mduhet me validu 'type'.
    public function rules()
    {
        return [
            'type' => 'bail|required|unique:types|min:3|max:200'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
   
    }

    public function messages()
    {
        return [
            'type.required' => 'A type is required!',
            'type.unique' => 'Type cannot be a duplicate!',
        ];
    }
}
