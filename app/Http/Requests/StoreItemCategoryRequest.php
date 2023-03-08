<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemCategoryRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'is_meter'=>'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Please enter a name for the category',
            'name.string'=>'Please enter a valid name for the category',
            'name.max'=>'Please enter a name with less than 255 characters',
        ];
    }
}
