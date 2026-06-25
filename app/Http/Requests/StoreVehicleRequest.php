<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->user() && auth('api')->user()->user_type === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                'string',
                'in:locomotive,metro,bus',
            ],
            'manufacturer' => [
                'required',
                'string',
                'max:50'
            ],
            'model' => [
                'required',
                'string'
            ],
            'year' => [
                'required',
                'integer',
                'between:1995,' . date('Y'),
                'digits:4'
            ],
            'license_plate'=>[
                'required',
                'string',
                'unique:vehicles,license_plate',
                'max:20'
            ],
            'capacity' => [
                'required',
                'integer',
                'min:1'
            ],
            'latitude' => [
                'nullable',
                'numeric'
            ],
            'longitude' => [
                'nullable',
                'numeric'
            ],
        ];
    }
}
