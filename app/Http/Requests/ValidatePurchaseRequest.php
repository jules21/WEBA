<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePurchaseRequest extends FormRequest
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
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'description' => ['required', 'string'],
            'items.*' => ['required', 'numeric'],
            'quantities.*' => ['required', 'numeric'],
            'prices.*' => ['required', 'numeric'],
            'vats.*' => ['required', 'numeric', 'min:0', 'max:100'],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'tax_amount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'At least one item is required',
            'items.*.item_id.required' => 'Item is required',
            'items.*.quantity.required' => 'Quantity is required',
            'items.*.price.required' => 'Price is required',
        ];
    }
}
