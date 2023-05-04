<?php

namespace App\Http\Requests;

use App\Rules\ValidateDocNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterClientRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'document_type_id' => ['required'],
            'doc_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('clients')->where(function ($query) {
                    return $query->where([
                        ['document_type_id', '=', request('document_type_id')],
                        ['id', '!=', request('id')],
                    ]);
                }),
                new ValidateDocNumber(),
            ],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:clients'],
            'phone' => ['required', 'string', 'max:255', 'unique:clients'],
            'legal_type_id' => ['required'],
            'province_id' => ['required'],
            'district_id' => ['required'],
            'sector_id' => ['required'],
            'cell_id' => ['required'],
            'village_id' => ['nullable', 'integer', 'exists:villages,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
