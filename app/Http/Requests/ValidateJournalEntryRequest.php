<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateJournalEntryRequest extends FormRequest
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
            'date' => ['required', 'date', 'before_or_equal:today'],
            'amount' => ['required'],
            'description' => ['required', 'string', 'max:2000'],
            'debit_ledger_croup' => ['required'],
            'debit_ledger' => ['required'],
            'credit_ledger_croup' => ['required'],
            'credit_ledger' => ['required'],
        ];
    }
}
