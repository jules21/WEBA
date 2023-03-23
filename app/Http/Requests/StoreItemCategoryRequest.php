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
            'operator_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Please enter a name for the category',
            'name.string'=>'Please enter a valid name for the category',
            'name.max'=>'Please enter a name with less than 255 characters',
            'is_meter.required'=>'Please select if the category is metered',
            'is_meter.boolean'=>'Please select if the category is metered',
            'operator_id.required'=>'Please select an operator',
        ];
    }
}
