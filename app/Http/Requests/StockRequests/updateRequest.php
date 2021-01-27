<?php

namespace App\Http\Requests\StockRequests;

use Illuminate\Foundation\Http\FormRequest;

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
            'id' => 'required|numeric|exists:'.(new Stock)->getTable().',id,deleted_at,NULL',
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()-json($validator->erros(), 422));
    }

    public function messages() 
    {
        return [
            'id.required' => 'Stock id is required',
            'id.numeric' => 'Id must be numeric',
            'id.exists' => 'Id has been deleted!',
        ];
    }
}
