<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     * Validate input requests
     *
     * @param Validator $validator
     * @return array
     * @since release of feature/onCarApp-01
     */
    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            $validator->errors()
        ],422
        ));
    }

    /**
     *
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *@since release of feature/onCarApp-01
     */
    public function rules(): array
    {
        return [
            //
            'modelo' => 'required|string|min:3',
            'marca' => 'required|string|min:3',
            'cor' => 'required|string|min:4',
        ];
    }


    /**
     *
     * return optimized messages of request validations
     *
     * @return string[]
     * @since release of feature/onCarApp-01
     */
    public function messages(): array
    {
        return [
            'modelo.required' => 'You need to set model name.',
            'modelo.string' => 'it must be a string',
            'modelo.min'=>  'you need to set model with at least 3 characters.',
            'marca.required' => 'you need to set marca.',
            'marca.string' => 'it must be a string.',
            'marca.min' => 'it must have at least 4 letters.',
            'cor.required' => 'you need to set cor.',
            'cor.string' => 'it must be a string',
            'cor.min' => 'must have at least 4 characters.',

        ];
    }
}
