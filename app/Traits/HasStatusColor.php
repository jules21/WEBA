<?php

namespace App\Traits;

use App\Constants\BalanceType;
use App\Models\Request;

trait HasStatusColor
{
    public function getStatusColorAttribute(): string
    {
        switch (strtolower($this->status)) {
            case 'pending':
            case 'active':
            case strtolower(Request::PARTIALLY_DELIVERED):
                return 'primary';
            case 'submitted':
            case 'assigned':
                return 'info';
            case 'approved':
            case 'paid':
            case 'delivered':
            case strtolower(BalanceType::CREDIT):
                return 'success';
            case 'rejected':
            case 'cancelled':
            case strtolower(BalanceType::DEBIT):
                return 'danger';
            case 'meter assigned':
                return 'green';
            default:
                return 'secondary';
        }
    }
}
