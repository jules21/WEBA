<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMappingRequest extends FormRequest
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
            'psp_account_id'=>'required',
            'account_number'=>'required',
        ];
    }

    function messages()
    {
        return [
            'account_number.required'=>'Account Name and Account Number is required'
        ];
    }
}
