<?php

namespace App\Traits;

trait HasEncryptId
{
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', decryptId($value))->firstOrFail();
    }
}
