<?php

namespace App\Traits;

use App\QueryScopes\OperatorScope;

trait ForOperator
{

    // register global scope in model
    protected static function booted()
    {
        static::addGlobalScope(new OperatorScope);
    }

}
