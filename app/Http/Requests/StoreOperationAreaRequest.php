<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationAreaRequest extends FormRequest
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
            'name' => ['required'],
            'district_id' => ['required_if:id,0'],
            'contact_person_name' => ['required', 'string', 'max:255'],
            'contact_person_phone' => ['required', 'string', 'max:50'],
            'contact_person_email' => ['nullable', 'email', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'district_id.required_if' => 'The district field is required.',
            'contact_person_name.required' => 'The contact person name field is required.',
            'contact_person_phone.required' => 'The contact person phone field is required.',
            'contact_person_email.email' => 'The contact person email must be a valid email address.',
        ];
    }
}
