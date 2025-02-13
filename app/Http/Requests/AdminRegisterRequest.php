<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AdminRegisterRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'nullable|email|unique:users',
            'mobile' => 'nullable|string|unique:users',
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
