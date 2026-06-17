<?php

namespace App\Services\Booking;

use App\Repositories\BookingRepository;

class BookingCreateService
{
    protected $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function create(array $data)
    {
        // Your create logic goes here
    }
}