<?php

namespace App\Traits;

trait HasInitials
{

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= $word[0];
        }
        return $initials;
    }

}
