<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperatorRequest extends FormRequest
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
            'operator_details' => ['required', 'json'],
            'cell_id' => ['required', 'exists:cells,id'],
            'village_id' => ['nullable', 'exists:villages,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'operator_details.required' => 'Operator details are required',
            'operator_details.json' => 'Operator details must be a valid json',
            'cell_id.required' => 'Cell is required',
            'cell_id.exists' => 'Cell does not exist',
            'village_id.required' => 'Village is required',
            'village_id.exists' => 'Village does not exist',
        ];
    }
}
