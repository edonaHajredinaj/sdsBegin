<?php

namespace App\Http\Requests\UserRequests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class loginRequest extends FormRequest
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
            'email' => 'bail|required|string|email|unique:users|exists:'.(new User)->getTable().',email,deleted_at,NULL',
            'password' => 'bail|required|string|confirmed|min:5',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    //nese nuk osht regjistru email ska nevoj me dal qe sosht confirm as passi
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.string' => 'Your email cannot be just a number or just a character !',
            'email.email' => 'Email has to be in an email format ex. name@example.com',
            'email.unique' => 'You email is a duplicate, choose another!',
            'email.exists' => 'Sorry, this email has not been registered, yet.',

            'password.required' => 'Password is required',
            'password.string' => 'Type id has to be a number!',
            'password.confirmed' => 'You have not confirmed your password!',
            'password.min' => 'Password cannot be less than 5!',

        ];
    }
}
