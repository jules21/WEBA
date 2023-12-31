<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserManualRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'file' => ['required_if:id,0', 'file', 'mimes:pdf'],
            'description' => ['required', 'string'],
            'title_kn' => ['required', 'string', 'max:255'],
            'file_kn' => ['required_if:id,0', 'file', 'mimes:pdf'],
            'description_kn' => ['required', 'string'],
            'for_admin' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'file.required_if' => 'The file field is required.',
            'file_kn.required_if' => 'The file field is required.',
        ];
    }
}
