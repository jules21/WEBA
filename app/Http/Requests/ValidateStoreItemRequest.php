<?php

namespace App\Http\Requests;

use App\Models\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateStoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'item_id' => [
                'required',
                'exists:items,id',
                Rule::unique('stock_movement_details')
                    ->where(function ($query) {
                        $query->where([
                            ['model_type', '=', Request::class],
                            ['model_id', '=', \request('request_id')],
                            ['id', '!=', \request('id')]
                        ]);
                    })

            ],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'item_id.required' => 'Item is required',
            'item_id.exists' => 'Item does not exist',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity must be a number',
            'quantity.min' => 'Quantity must be greater than 0',
            'unit_price.required' => 'Unit price is required',
            'unit_price.numeric' => 'Unit price must be a number',
            'unit_price.min' => 'Unit price must be greater than 0',
            'item_id.unique' => "Item already added to list"
        ];
    }

}
