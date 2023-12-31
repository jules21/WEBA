<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUpdateUser extends FormRequest
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
            'email' => 'nullable|email|unique:users,email,'.request()->route()->parameter('user_id'),
            'phone' => 'nullable',
            'operator_id' => 'nullable',
            'status' => 'nullable',
            //            'phone' => 'nullable|regex:/^[07][0-9]{9}$/|unique:users,telephone,'.request()->route()->parameter('user_id'),
            'operation_area' => 'nullable',
//            'institution_id' => 'required_if:operator_id,==,null',
            'institution_id' => 'nullable',
            'district_id' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            //            'phone.required' => 'Telephone field is required',
            //            'phone.regex' => 'Telephone field must be start with 07 and must be 10 digits',
            'institution_id.required_if' => 'Institution field is required if Operator field is empty',
        ];
    }
}
