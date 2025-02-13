<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class jobRequest extends FormRequest
{
  

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'jobs' => 'required|array|min:1',
            'jobs.*.title' => 'required|string|max:255',
            'jobs.*.description' => 'required|string',
            'jobs.*.location' => 'required|string|max:255',
            'jobs.*.salary' => 'required|numeric|min:0',
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
