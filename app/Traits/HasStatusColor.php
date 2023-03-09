<?php

namespace App\Traits;

trait HasStatusColor
{
    public function getStatusColorAttribute(): string
    {
        switch (strtolower($this->status)) {
            case 'pending':
                return 'primary';
            case 'submitted':
            case 'assigned':
                return 'info';
            case 'approved':
                return 'success';
            case 'rejected':
                return 'danger';
            default:
                return 'secondary';
        }
    }


}
