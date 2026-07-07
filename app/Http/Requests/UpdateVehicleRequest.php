<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'type' => [
                'required',
                'string',
                'in:locomotive,metro,bus'
            ],
            'manufacturer' => [
                'required',
                'string',
                'max:50'
            ],
            'model' => [
                'required',
                'string',
                'max:20',
            ],
            'year' => [
                'required',
                'integer',
                'between:1995,' . date('Y'),
            ],
            'image' => [
                'nullable',
                'string'
            ],
            'license_plate' => [
                'nullable',
                'string',
                'max:20',
                'unique:vehicles,license_plate',
            ],
            'capacity' => [
                'required',
                'integer',
                'min:1',
                'max:500'
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
