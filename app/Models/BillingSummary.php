<?php

namespace App\Models;

class BillingSummary
{
    public string $customer_name;
    public string $subscription_number;
    public float $total_balance_due;
    public float $total_amount_paid;

    public function __construct(string $customer_name,string $subscription_number,float $total_balance_due, float $total_amount_paid)
    {
        $this->customer_name = $customer_name;
        $this->total_balance_due = $total_balance_due;
        $this->total_amount_paid = $total_amount_paid;
        $this->subscription_number = $subscription_number;
    }
}
