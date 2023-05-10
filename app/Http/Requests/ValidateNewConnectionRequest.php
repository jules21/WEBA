<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNewConnectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth('client')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'water_usage_id' => ['required'],
            'meter_qty' => ['required', 'numeric', 'min:1'],
            'upi' => ['required', 'string'],
            'upi_attachment' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png'],
            'sector_id' => ['required'],
            'cell_id' => ['required'],
            'village_id' => ['nullable'],
            'description' => ['nullable', 'string'],
            'new_connection_crosses_road' => ['required'],
            'road_type' => ['required_if:new_connection_crosses_road,1'],
            'road_cross_types' => ['required', 'array'],
            'road_cross_types.*' => ['required', 'numeric'],
            'digging_pipeline' => ['required'],
            'equipment_payment' => ['required'],
        ];
    }
}
