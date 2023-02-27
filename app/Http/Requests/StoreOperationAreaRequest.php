<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationAreaRequest extends FormRequest
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
            'name' => ['required'],
            'district_id' => ['required', 'exists:districts,id'],
            'contact_person_name' => ['required', 'string', 'max:255'],
            'contact_person_phone' => ['required', 'string', 'max:50'],
            'contact_person_email' => ['nullable', 'email', 'max:100'],
        ];
    }
}
