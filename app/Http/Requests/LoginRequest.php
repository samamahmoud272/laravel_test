<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 
use Illuminate\Http\Request;  
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'identifier' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }


protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'message' => 'Validation failed',
        'errors' => $validator->errors(),
    ], 422));
}
}
