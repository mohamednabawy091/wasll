<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->check() && auth('api')->user()->user_type === 'admin';

        // $user = auth('api')->user();
        // dd(method_exists($user, 'isAdmin'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'driver_id' => [
                'nullable',
                'exists:drivers,id',
            ],
            'vehicle_id' => [
                'nullable',
                'exists:vehicles,id',
            ],
            'route_id' => [
                'required',
                'exists:routes,id'
            ],
            'pickup_location' => [
                'required',
                'string',
                'max:255'
            ],
            'pickup_latitude' => [
                'required',
                'numeric',
            ],
            'pickup_longitude' => [
                'required',
                'numeric'
            ],
            'destination_location' => [
                'required',
                'string'
            ],
            'destination_latitude' => [
                'required',
                'numeric',
                'between:-90,90'
            ],
            'destination_longitude' => [
                'required',
                'numeric',
                'between:-180,180'
            ],
            'scheduled_arrival' => [
                'required',
                'date'
            ],
            'actual_pickup_time' => [
                'nullable',
                'date'
            ],
            'actual_dropoff_time' => [
                'nullable',
                'date'
            ],
            'status' => [
                'nullable',
                'in:pending,assigned,in_progress,completed,cancelled',
            ],
            'fare_amount' => [
                'required',
                'numeric'
            ]
        ];
    }
}
