<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateAppRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer'],
            'request_type_id' => ['required', 'integer'],
            'water_usage_id' => ['required', 'integer'],
            'sector_id' => ['required', 'integer'],
            'cell_id' => ['required', 'integer'],
            'village_id' => ['nullable'],
            'upi' => ['required', 'string'],
            'meter_qty' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string'],
     /*       'new_connection_crosses_road' => ['required', 'string'],
            'road_type' => ['required_if:new_connection_crosses_road,1'],*/
            'equipment_payment' => ['required', 'string'],
            'digging_pipeline' => ['required', 'string'],
            'upi_attachment' => ['required_if:id,0', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:1024'],
            'road_cross_types' => ['nullable', 'array'],
            'form_attachment' => [
                Rule::requiredIf(fn() => request('id') == 0 && auth()->id() > 0),
                'file', 'mimes:pdf,jpg,jpeg,png', 'max:1024'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Customer is required',
            'request_type_id.required' => 'Request type is required',
            'water_usage_id.required' => 'Water usage is required',
            'province_id.required' => 'Province is required',
            'district_id.required' => 'District is required',
            'sector_id.required' => 'Sector is required',
            'cell_id.required' => 'Cell is required',
            'village_id.required' => 'Village is required',
            'upi.required' => 'UPI is required',
            'meter_qty.required' => 'Meter quantity is required',
            'description.required' => 'Description is required',
            'new_connection_crosses_road.required' => 'This field is required',
            'road_type.required' => 'Road type is required',
            'road_type.required_if' => 'Road type is required',
            'equipment_payment.required' => 'This field is required',
            'digging_pipeline.required' => 'This field is required',
            'upi_attachment.required_if' => 'UPI attachment is required',

        ];
    }
}
