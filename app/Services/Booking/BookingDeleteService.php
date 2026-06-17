<?php

namespace App\Services\Booking;

use App\Repositories\BookingRepository;

class BookingDeleteService
{
    protected $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}