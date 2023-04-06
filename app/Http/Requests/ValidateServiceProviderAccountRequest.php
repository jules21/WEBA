<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateServiceProviderAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'payment_service_provider_id' => [
                'required',
                'exists:payment_service_providers,id',
            ],
            'account_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'opening_date' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }
}
