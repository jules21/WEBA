<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'item_category_id' => 'required',
            'name' => 'required|string|max:255|unique:items,name,NULL,id,operator_id,'.$this->operator_id,
            'description' => 'required',

            'is_active' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'item_category_id.required' => 'Please select a category',
            'name.required' => 'Please enter a name',
            'description.required' => 'Please enter a description',
            'name.unique' => 'Item already exists',
        ];
    }
}
