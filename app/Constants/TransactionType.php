<?php

namespace App\Constants;

class TransactionType
{
    const DEPOSIT = 'Deposit';

    const WITHDRAW = 'Withdraw';

    public static function getTypes(): array
    {
        return [
            self::DEPOSIT,
            self::WITHDRAW,
        ];
    }
}
