<?php

namespace App\Http\Requests;

use App\Constants\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use function implode;

class ValidateCashMovementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'psp_id' => ['required'],
            'psp_account_id' => ['required'],
            'amount' => ['required'],
            'transaction_type' => ['required', 'in:' . implode(',', TransactionType::getTypes())],
            'date' => ['required', 'date'],
            'description' => ['required'],
            'reference_no' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'psp_id.required' => 'Please select a bank',
            'psp_account_id.required' => 'Please select a bank account',
            'amount.required' => 'Please enter an amount',
            'transaction_type.required' => 'Please select a transaction type',
            'transaction_type.in' => 'Please select a valid transaction type',
            'date.required' => 'Please select a date',
            'date.date' => 'Please select a valid date',
            'description.required' => 'Please enter a description',
            'reference_no.required' => 'Please enter a reference number',
        ];
    }
}
