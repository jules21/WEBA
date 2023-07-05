<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClusterRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('clusters', 'name')
                    ->where('district_id', $this->district_id)
                    ->ignore($this->id),
                'string',
                'max:255'
            ],
//            'expiration_date' => ['required', 'date'],
            'district_id' => ['required', 'exists:districts,id'],
            'sectors' => ['required', 'array'],
            'sectors.*' => ['required', 'exists:sectors,id'],
            'water_networks' => ['required', 'array'],
            'water_networks.*' => ['required', 'exists:water_networks,id'],
        ];
    }
}
