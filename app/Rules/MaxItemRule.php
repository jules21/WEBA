<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxItemRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        info(request()->input('available_quantity'));
        if($value > request()->input('available_quantity')) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The quantity must be less than or equal to available quantity:'.request()->input('available_quantity');
    }
}
