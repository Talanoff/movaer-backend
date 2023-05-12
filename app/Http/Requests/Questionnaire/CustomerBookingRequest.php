<?php

namespace App\Http\Requests\Questionnaire;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required_if:registerCheckbox,true', 'string', 'max:191'],
            'email' => ['required_if:registerCheckbox,true', 'email', 'unique:users,email'],
            'phone' => ['required_if:registerCheckbox,true', 'string', 'max:191'],
            'password' => ['required', Password::min(6)],
        ];
    }
}
