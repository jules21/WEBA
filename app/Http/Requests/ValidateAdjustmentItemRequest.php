<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAdjustmentItemRequest extends FormRequest
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
            //item id is required and unique on the stock movement details table
//            'item_id' => ['required', 'unique:stock_movement_details,item_id'],
            'item_id' => ['required'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'unit_price' => ['required', 'numeric', 'min:1'],
            'adjustment_type' => ['required', 'in:increase,decrease'],
            'description' => ['nullable', 'string', 'max:255'],
            'adjustment_id' => ['required'],
        ];
    }
}
