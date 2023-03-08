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
            'items' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    if (count($value) < 1) {
                        $fail('At least one item is required');
                    }
                }
            ],
            'items.*.item_id' => ['required', 'exists:items,id'],
            'items.*.quantity' => ['required', 'numeric', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:1']
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
