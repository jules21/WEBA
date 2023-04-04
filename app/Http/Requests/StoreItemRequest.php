<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            "item_category_id" => 'required',
            'name'=>'required|string|max:255|unique:items,name,NULL,id,operator_id,'.$this->operator_id,
            "description" => 'required',
            "packaging_unit_id" => 'required',
            "selling_price" => 'required',
            "vatable" => 'required',
            "vat_rate" => 'required_if:vatable,1',
            "operator_id" => 'required',
        ];
    }

    public function messages():array
    {
        return [
            "item_category_id.required" => "Please select a category",
            "name.required" => "Please enter a name",
            "description.required" => "Please enter a description",
            "packaging_unit_id.required" => "Please select a packaging unit",
            "selling_price.required" => "Please enter a selling price",
            "vatable.required" => "Please select if the item is vatable",
            "vat_rate.required" => "Please enter a VAT rate",
            "vat_rate.required_if" => "Please enter a VAT rate",
            "operator_id.required" => "Please select an operator",
        ];
    }
}
