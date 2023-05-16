<?php

namespace App\Models;

class CustomerOverview
{
    public int $totalRequests;

    public int $totalConnections;

    public float $totalAmountDue;

    public function __construct(int $totalRequests, int $totalConnections, float $totalAmountDue)
    {
        $this->totalRequests = $totalRequests;
        $this->totalConnections = $totalConnections;
        $this->totalAmountDue = $totalAmountDue;
    }


}
