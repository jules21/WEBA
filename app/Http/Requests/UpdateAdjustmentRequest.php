<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdjustmentRequest extends FormRequest
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
            'status' => 'required|string|max:50',
            'description' => 'required|string',
            'operation_area_id' => 'required|integer',
            'created_by' => 'required|integer',
            'approved_by' => 'nullable|integer',
        ];
    }
}
