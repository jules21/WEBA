<?php

namespace App\Http\Requests;

use App\Rules\ValidateDocNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'document_type_id' => ['required'],
            'doc_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('customers')->where(function ($query) {
                    return $query->where([
                        ['document_type_id', '=', request('document_type_id')],
                        ['document_type_id', '=', request('document_type_id')],
                        ['operator_id', '=', auth()->user()->operator_id],
                        ['id', '!=', request('id')],
                    ]);
                }),
                new ValidateDocNumber(),
            ],
            //            'input_doc_number' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'legal_type_id' => ['required'],
            'province_id' => ['required'],
            'district_id' => ['required'],
            'sector_id' => ['required'],
            'cell_id' => ['required'],
            //            'village_id' => ['nullable', 'integer', 'exists:villages,id'],
        ];
    }
}
