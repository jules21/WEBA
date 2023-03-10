<?php

namespace App\Traits;

use ReflectionClass;

trait GetClassName
{

    // static method to get class name with namespace
    public function getClassName(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

}
