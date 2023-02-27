<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRequestDurationConfiguration extends FormRequest
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
            'request_type_id'=>'required',
            'operator_id'=>'required',
            'operation_area_id'=>'required',
            'processing_days'=>'required',
            'is_active'=>'required',
        ];
    }
}
