<?php

namespace App\Constants;

use phpDocumentor\Reflection\Types\Self_;

class Status
{
    const PENDING = 'Pending';

    const SUBMITTED = 'Submitted';

    const APPROVED = 'Approved';

    const REJECTED = 'Rejected';


    const CANCELLED = 'Cancelled';

    const ACTIVE = 'Active';

    const INACTIVE = 'Inactive';

    const SUSPENDED = 'Suspended';

    const CLOSED = 'Closed';

    const RETURN_BACK = 'Return Back';
    const ASSIGNED = 'Assigned';

    const PROPOSE_TO_APPROVE = 'Propose to approve';

    const METER_ASSIGNED = 'Meter Assigned';

    const PARTIALLY_DELIVERED = 'Partially Delivered';

    const DELIVERED = 'Delivered';

    const RE_SUBMITTED = 'Re-Submitted';
    const PAID = "Paid";

    const REVIEWED = "Reviewed";
    const RESOLVED = "Resolved";


    public static function getRequestStatuses(): array
    {
        $allStatuses = (new \ReflectionClass(self::class))->getConstants();
        $excluded = [self::ACTIVE, self::INACTIVE, self::SUSPENDED, self::CLOSED, self::PROPOSE_TO_APPROVE];
        return array_filter($allStatuses, function ($status) use ($excluded) {
            return !in_array($status, $excluded);
        });
    }

    public static function pendingStatuses(): array
    {
        return [self::REJECTED, self::ASSIGNED, self::PENDING, self::SUBMITTED, self::PROPOSE_TO_APPROVE, self::RETURN_BACK, self::RE_SUBMITTED];
    }

    public static function approvalStatuses(): array
    {
        return [self::APPROVED, self::METER_ASSIGNED, self::PARTIALLY_DELIVERED, self::DELIVERED];
    }

    public static function issueStatues(): array
    {
        return [self::PENDING, self::REVIEWED, self::RESOLVED];
    }

    public static function stockStatuses(): array
    {
        return [self::PENDING, self::SUBMITTED, self::APPROVED, self::REJECTED, self::CANCELLED, Self::RETURN_BACK];
    }
}
