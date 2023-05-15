<?php

namespace App\Http\Requests;

use App\Rules\MatchClientPassword;
use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangeClientPasswordRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', new MatchClientPassword()],
            //            'new_password' => ['required', 'min:6'],
            'new_password' => ['required', 'min:6',
                //                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
            ],
            'new_confirm_password' => ['same:new_password'],
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.regex' => 'Your password must be more than 6 characters long',
        ];
    }
}
