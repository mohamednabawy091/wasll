<?php

namespace App\Services\\Ticket;

use App\Repositories\TicketRepository;

class TicketDeleteService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}