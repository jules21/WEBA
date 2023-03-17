<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'amount' => ['required'],
            'description' => ['required', 'string', 'max:2000'],
            'expense_ledger' => ['required'],
            'expense_category' => ['required'],
            'payment_ledger' => ['required'],
        ];
    }
}
