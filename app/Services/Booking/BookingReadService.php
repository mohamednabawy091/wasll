<?php

namespace App\Services\Booking;

use App\Repositories\BookingRepository;

class BookingReadService
{
    protected $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function read(array $data)
    {
        // Your create logic goes here
    }
}