<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'phone' => [
                'required', 'unique:users',
                app()->environment('production') ? 'regex:/^[07][0-9]{9}$/' : 'max:20',
            ],
            'operator_id' => 'nullable',
            'operation_area' => 'nullable',
            'institution_id' => 'required_if:operator_id,==,null',
            'district_id' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'phone.required' => 'Telephone field is required',
            'phone.regex' => 'Telephone field must be start with 07 and must be 10 digits',
            'institution_id.required_if' => 'Institution field is required if Operator field is empty',
        ];
    }
}
