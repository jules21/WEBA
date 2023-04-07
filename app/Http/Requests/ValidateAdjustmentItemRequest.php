<?php

namespace App\Http\Requests;

use App\Models\Adjustment;
use App\Rules\MaxItemRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'item_id' => [
                'required',
                Rule::unique('stock_movement_details', 'item_id')->where(function ($query) {
                    return $query->where('model_type', Adjustment::class)
                        ->where([
                            ['model_id','=', request()->adjustment_id],
                            ['id', '<>', request()->id]
                        ]);
                }),
            ],
            'quantity' => ['required', 'numeric', 'min:1',new MaxItemRule()],
            'unit_price' => ['required', 'numeric', 'min:1'],
            'adjustment_type' => ['required', 'in:increase,decrease'],
            'description' => ['nullable', 'string', 'max:255'],
            'adjustment_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'item_id.unique' => 'The item has already been added.',
        ];
    }
}
