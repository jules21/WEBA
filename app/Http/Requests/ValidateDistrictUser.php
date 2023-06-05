<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateDistrictUser extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'phone' => [
                'required', 'unique:users',
                app()->environment('production') ? 'regex:/^[07][0-9]{9}$/' : 'max:20',
            ],
            'district_id' => 'required',
        ];
    }
}
