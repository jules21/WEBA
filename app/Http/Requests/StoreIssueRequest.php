<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIssueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('client')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'operator_id' => ['required', 'exists:operators,id'],
            'operation_area_id' => ['required', 'exists:operation_areas,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'operator_id.required' => 'Please select an operator',
            'operator_id.exists' => 'Please select a valid operator',
            'operation_area_id.required' => 'Please select an operation area',
            'operation_area_id.exists' => 'Please select a valid operation area',
            'title.required' => 'Please enter a title',
            'title.string' => 'Please enter a valid title',
            'title.max' => 'Title should not exceed 255 characters',
            'description.required' => 'Please enter a description',
            'description.string' => 'Please enter a valid description',
        ];
    }
}
