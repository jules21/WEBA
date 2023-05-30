<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpeg,jpg,png,PNG', 'max:1024'],
            'comment' => ['required', 'string', 'max:500'],
        ];
    }
}
