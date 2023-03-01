<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAssignRequest extends FormRequest
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
            'request_ids' => [
                'required',
                'array',
                'exists:requests,id',
            ],
            'user_id' => [
                'required',
                'exists:users,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'request_ids.required' => 'Please select at least one request',
            'request_ids.array' => 'Please select at least one request',
            'request_ids.exists' => 'Please select at least one request',
            'user_id.required' => 'Please select a user',
            'user_id.exists' => 'Please select a user',
        ];
    }
}
