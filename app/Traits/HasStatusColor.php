<?php

namespace App\Traits;

use App\Constants\BalanceType;
use App\Constants\Status;
use App\Models\Request;

trait HasStatusColor
{
    public function getStatusColorAttribute(): string
    {
        switch (strtolower($this->status)) {
            case strtolower(Status::PENDING):
            case strtolower(Status::ACTIVE):
            case strtolower(Status::PARTIALLY_DELIVERED):
                return 'primary';
            case strtolower(Status::SUBMITTED):
            case strtolower(Status::ASSIGNED):
                return 'info';
            case strtolower(Status::APPROVED):
            case strtolower(Status::PAID):
            case strtolower(Status::DELIVERED):
            case strtolower(BalanceType::CREDIT):
                return 'success';
            case strtolower(Status::RETURN_BACK):
                return 'warning';
            case strtolower(Status::REJECTED):
            case strtolower(Status::CANCELLED):
            case strtolower(BalanceType::DEBIT):
                return 'danger';
            case strtolower(Status::METER_ASSIGNED):
                return 'green';
            default:
                return 'secondary';
        }
    }
}
