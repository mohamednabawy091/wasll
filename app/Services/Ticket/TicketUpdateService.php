<?php

namespace App\Services\\Ticket;

use App\Repositories\TicketRepository;

class TicketUpdateService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}