<?php

namespace App\Constants;

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


    public static function getRequestStatuses(){
        $allStatuses = (new \ReflectionClass(self::class))->getConstants();
        $excluded = [self::ACTIVE,self::INACTIVE, self::SUSPENDED, self::CLOSED, self::PROPOSE_TO_APPROVE];
        return array_filter($allStatuses, function ($status) use ($excluded) {
            return !in_array($status, $excluded);
        });
    }
}
