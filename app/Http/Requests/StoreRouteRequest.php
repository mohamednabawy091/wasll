<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return auth('api')->check() && auth('api')->user()->user_type === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'type' => [
                'required',
                'in:bus,metro,train'
            ],
            'start_location' => [
                'required',
                'string'
            ],
            'end_location' => [
                'required',
                'string'
            ],
            'distance_km' => [
                'required',
                'numeric'
            ],
            'estimated_duration_minutes' => [
                'required',
                'integer'
            ],
            'is_active' => [
                'required',
                'boolean'
            ]
        ];
    }
}
