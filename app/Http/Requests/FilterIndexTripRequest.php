<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterIndexTripRequest extends FormRequest
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
            'status' => [
                'nullable',
                'string',
                'in:pending,assigned,in_progress,completed,cancelled'
            ],
            'route_id' => [
                'nullable',
                'exists:routes,id',
            ],
            'from_date' => [
                'nullable',
                'date'
            ],
            'to_date' => [
                'nullable',
                'date',
                'after_or_equal:from_date'
            ],
            'per_page' => [
                'nullable',
                'integer',
                'min:1',
                'max:100'
            ],

        ];
    }
}
