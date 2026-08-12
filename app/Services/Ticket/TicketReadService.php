<?php

namespace App\Services\\Ticket;

use App\Repositories\TicketRepository;

class TicketReadService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function read(array $data)
    {
        // Your create logic goes here
    }
}