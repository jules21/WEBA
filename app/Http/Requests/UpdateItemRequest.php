<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            "item_category_id" => 'required',
            "name" => 'required',
            "description" => 'required',
            "packaging_unit_id" => 'required',
            "selling_price" => 'required',
            "vatable" => 'required',
            "vat_rate" => 'required_if:vatable,1',
        ];
    }

    public function messages()
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
        ];
    }
}
