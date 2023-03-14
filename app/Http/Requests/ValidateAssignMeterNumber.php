<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAssignMeterNumber extends FormRequest
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
            'item_category_id' => ['required', 'exists:item_categories,id'],
            'item_id' => ['required', 'exists:items,id'],
            'meter_number' => ['required'],
            'last_index' => ['required', 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'item_category_id.required' => 'Please select an item category',
            'item_category_id.exists' => 'Please select a valid item category',
            'item_id.required' => 'Please select an item',
            'item_id.exists' => 'Please select a valid item',
            'meter_number.required' => 'Please enter a meter number',
            'last_index.required' => 'Please enter a last index',
            'last_index.numeric' => 'Last index must be a number'
        ];
    }
}
