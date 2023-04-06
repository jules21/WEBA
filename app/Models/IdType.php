<?php

namespace App\Models;

class IdType
{
    const NationalId = 'National ID';

    const Passport = 'Passport';

    const RcaNumber = 'RCA Number';

    const Tin = 'TIN';

    const RgbNumber = ' RGB Number';

    public static function get(): array
    {
        return [
            self::NationalId,
            self::Passport,
            self::RcaNumber,
            self::Tin,
            self::RgbNumber,
        ];
    }
}
