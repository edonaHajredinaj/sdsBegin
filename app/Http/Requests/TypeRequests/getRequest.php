<?php

namespace App\Http\Requests\TypeRequests;

use App\Type;
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
            'id' => 'required|numeric|exists:'.(new Type)->getTable().',id',
            // ->where('id', '[0-9]+')
        ];
    }

    // public function all($keys = null)
    // {
    //     $attributes = parent::all($keys);
    //     $attributes['id'] = $this->route()[2]['id'];
    //     return $attributes;
    // }

    public function all($keys = null)
{
    $data = parent::all($keys);
    $data['id'] =  $this->route('id');
    return $data;
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
            'id.exists' => 'Id does not exist'
        ];
    }
}
