<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registerRequest extends FormRequest
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
            'name' => 'required|string|between:2,99',
            'email' => 'bail|required|email|string|min:4|unique:users',
            'password' => 'bail|required|string|min:5',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name should only contain letters a-z',
            'name.between' => 'Name cannot be less than 2 characters or more than 99 characters!',

            'email.required' => 'Email is required!',
            'email.email' => 'Email has to be in an email format ex. name@example.com',
            'email.string' => 'Your email cannot be just a number or just a character !',
            'email.min' => 'Email cannot be less than 4 characters!',
            'email.unique' => 'You email is a duplicate, pick another!',

            'password.required' => 'Password is required',
            'password.string' => 'Type id has to be a number!',
            //'password.confirmed' => 'You have not confirmed your password!',
            'password.min' => 'Password cannot be less than 5!',

        ];
    }
}
