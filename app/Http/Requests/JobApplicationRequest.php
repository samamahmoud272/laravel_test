<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;  
use Illuminate\Http\Exceptions\HttpResponseException;
class JobApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->is_admin === 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [
            'availablejobs_id' => 'required|exists:Availablejobs,id',
            'cover_letter' => 'nullable|string',
            'file' => 'required|file|max:2048',
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
