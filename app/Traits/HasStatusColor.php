<?php

namespace App\Traits;

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
                return 'success';
            case 'rejected':
            case 'cancelled':
                return 'danger';
            case 'meter assigned':
                return 'green';
            default:
                return 'secondary';
        }
    }


}
