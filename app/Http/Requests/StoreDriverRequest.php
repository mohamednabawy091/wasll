<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'user_id' => [
                'required',
                'exists:users,id',
                'unique:drivers,user_id'
            ],
            'license_number' => [
                'required',
                'string',
                'max:50',
                'unique:drivers,license_number'
            ],
            'license_expiry_date' => [
                'required',
                'date'
            ],
            'is_verified' => [
                'nullable',
                'boolean'
            ],
            'rating' => [
                'nullable',
                'numeric',
                'between:0,5'
            ],
            'total_trips' => [
                'nullable',
                'integer'
            ],
            'status' => [
                'required',
                'in:available,busy,offline'
            ],
        ];
    }
}
