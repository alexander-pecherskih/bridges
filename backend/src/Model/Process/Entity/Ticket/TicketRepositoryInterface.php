<?php

namespace App\Model\Process\Entity\Ticket;

interface TicketRepositoryInterface
{
    public function nextId(): Id;
}
