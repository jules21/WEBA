<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateDocNumber implements Rule
{
    private int $len;

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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $id = request('document_type_id');
        if ($id == config("app.NATIONAL_ID")) {
            $this->len = 16;
            return $this->validateNationalId($value);
        } else if ($id == 4) {
            $this->len = 9;
            return strlen($value) == 9;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "The document number must be $this->len characters long.";
    }

    private function validateNationalId($value): bool
    {
        return !(strlen($value) != 16);
    }
}
