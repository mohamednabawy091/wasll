<?php

namespace App\Http\Requests;

use App\Enum\BookingStatusEnum;
use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterBookingIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Booking::class);
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
                new Enum(BookingStatusEnum::class),
            ],

            'trip_id' => [
                'nullable',
                'exists:trips,id'
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
                'max"100'
            ],
        ];
    }
}
