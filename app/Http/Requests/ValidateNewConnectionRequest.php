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
    public function rules(): array
    {
        return [
            'water_usage_id' => ['required'],
            'meter_qty' => ['required', 'numeric', 'min:1'],
            'upi' => ['required', 'string'],
            'upi_attachment' => ['required_if:id,0', 'file', 'mimes:pdf,jpg,jpeg,png'],
            'province_id' => ['required'],
            'district_id' => ['required'],
            'sector_id' => ['required'],
            'cell_id' => ['required'],
            'village_id' => ['nullable'],
            'description' => ['nullable', 'string'],
//            'new_connection_crosses_road' => ['required'],
//            'road_type' => ['required_if:new_connection_crosses_road,1'],
//            'road_cross_types' => ['required', 'array'],
//            'road_cross_types.*' => ['required', 'numeric'],
            'digging_pipeline' => ['required'],
//            'equipment_payment' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'water_usage_id.required' => 'Water usage is required',
            'meter_qty.required' => 'Meter quantity is required',
            'meter_qty.numeric' => 'Meter quantity must be a number',
            'meter_qty.min' => 'Meter quantity must be at least 1',
            'upi.required' => 'UPI is required',
            'upi.string' => 'UPI must be a string',
            'upi_attachment.required_if' => 'UPI attachment is required',
            'upi_attachment.file' => 'UPI attachment must be a file',
            'upi_attachment.mimes' => 'UPI attachment must be a pdf, jpg, jpeg, or png',
            'sector_id.required' => 'Sector is required',
            'cell_id.required' => 'Cell is required',
            'village_id.required' => 'Village is required',
            'description.string' => 'Description must be a string',
            'new_connection_crosses_road.required' => 'This field is required',
            'road_type.required_if' => 'Road type is required',
            'road_cross_types.required' => 'Road cross types are required',
            'road_cross_types.array' => 'Road cross types must be an array',
            'road_cross_types.*.required' => 'Road cross type is required',
            'road_cross_types.*.numeric' => 'Road cross type must be a number',
            'digging_pipeline.required' => 'This field is required',
            'equipment_payment.required' => 'This field is required',
        ];
    }
}
