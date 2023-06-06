<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'operator_id' => 'required|integer',
            'name' => 'required|string|max:255|unique:suppliers',
            'phone_number' => 'required|string|max:255|unique:suppliers',
            'email' => 'nullable|string|email|max:255|unique:suppliers',
            'address' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'operator_id.required' => 'Please select an operator',
            'name.required' => 'Please enter a name',
            'phone_number.required' => 'Please enter a phone number',
            'email.required' => 'Please enter an email',
            'address.required' => 'Please enter an address',
            'contact_name.required' => 'Please enter a contact name',
            'name.unique' => 'This name already exist',
            'phone_number.unique' => 'Phone number already exist',
            'email.unique' => 'Email already exist',
        ];
    }
}
