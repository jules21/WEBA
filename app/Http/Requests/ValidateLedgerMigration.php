<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateLedgerMigration extends FormRequest
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
            'ledger_group' => ['required'],
            'ledger_category' => ['required'],
            'amount' => ['required'],
            'balance_type' => ['required'],
            'ledger_id' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'ledger_group.required' => 'Ledger Group is required',
            'ledger_category.required' => 'Ledger Category is required',
            'amount.required' => 'Amount is required',
            'balance_type.required' => 'Balance Type is required',
            'ledger_id.required' => 'Ledger is required',
        ];
    }
}
