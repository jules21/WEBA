<?php

namespace App\Constants;

class BalanceType
{
    const CREDIT = 'Credit';

    const DEBIT = 'Debit';

    public static function types(): array
    {
        return [
            self::CREDIT,
            self::DEBIT,
        ];
    }
}
