<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'item_id' => ['required', 'exists:items,id',
                Rule::unique('meter_requests')->where(function ($query) {
                    return $query->where('request_id', request('request_id'));
                })->ignore(request('id'))
            ],
            'meter_number' => [
                'required',
//                Rule::unique("meter_requests")->ignore(request('id'))
            ],
            'last_index' => ['required', 'numeric', 'integer']
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
            'last_index.numeric' => 'Last index must be a number',
            'meter_number.unique' => "Meter number already exists",
            'item_id.unique' => "Item already exists",
        ];
    }
}
