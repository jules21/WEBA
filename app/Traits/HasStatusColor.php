<?php

namespace App\Traits;

trait HasStatusColor
{
    public function getStatusColorAttribute(): string
    {
        switch (strtolower($this->status)) {
            case 'pending':
            case 'active':
                return 'primary';
            case 'submitted':
            case 'assigned':
                return 'info';
            case 'approved':
            case 'paid':
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
