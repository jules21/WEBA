<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAddWaterNetwork extends FormRequest
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
            'water_network_id' => ['required', 'exists:water_networks,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'water_network_id.required' => 'Please select a water network',
            'water_network_id.exists' => 'Please select a valid water network',
        ];
    }
}
