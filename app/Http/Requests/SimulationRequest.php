<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SimulationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "nome"     =>'required|string',
            "sobrenome"=>'required|string',
            "endereco" =>'required|string',
            "cidade"   =>'required|string',
            "estado"   =>'required|string',
            "cep"      =>'required|string',
            "car_id"   =>'required|integer'
        ];
    }

    /**
     *
     * return optimized messages of request validations
     *
     * @return string[]
     * @since release of feature/onCarApp-03
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'You need to set a name.',
            'nome.string' => 'it must be a string',
            'sobrenome.required' => 'You need to set a sobrenome.',
            'sobrenome.string' => 'it must be a string',
            'estado.required' => 'You need to set a estado.',
            'estado.string' => 'it must be a string',
            'endereco.required' => 'You need to set a address.',
            'endereco.string' => 'it must be a string',
            'cidade.required' => 'You need to set a cidade.',
            'cidade.string' => 'it must be a string',
            'cep.required' => 'You need to set a cep.',
            'cep.string'    => 'it must be a string',
            'car_id.required' => 'You need to set a car_id.',
            'car_id.string' => 'it must be a integer',

        ];
    }

    /**
     *
     * Validate input requests
     *
     * @param Validator $validator
     * @return array
     * @since release of feature/onCarApp-03
     */
    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            $validator->errors()
        ],422
        ));
    }
}
