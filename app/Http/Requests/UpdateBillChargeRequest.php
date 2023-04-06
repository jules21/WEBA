<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBillChargeRequest extends FormRequest
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
            'water_network_type_id' => [
                'required',
                Rule::unique('bill_charges')->where(function ($query) {
                    return $query->where([
                        ['operation_area_id', '=', request('operation_area_id')],
                        ['water_network_type_id', '=', request('water_network_type_id')],
                    ]);
                }),
            ],
            'operation_area_id' => [
                'required',
                Rule::unique('bill_charges')->where(function ($query) {
                    return $query->where([
                        ['operation_area_id', '=', request('operation_area_id')],
                        ['water_network_type_id', '=', request('water_network_type_id')],
                    ]);
                }),
            ],
            'unit_price' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'water_network_type_id.required' => 'Water Network Type is required',
            'water_network_type_id.unique' => 'Water Network Type already exists',
            'operation_area_id.required' => 'Operation Area is required',
            'operation_area_id.unique' => 'Operation Area already exists',
            'unit_price.required' => 'Unit Price is required',
        ];
    }
}
