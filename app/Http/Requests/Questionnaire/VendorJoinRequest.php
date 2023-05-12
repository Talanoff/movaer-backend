<?php

namespace App\Http\Requests\Questionnaire;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class VendorJoinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'companyName' => ['required', 'string', 'max:191'],
            'commerceNumber' => ['required', 'string', 'max:191'],
            'iban' => ['required', 'string', 'max:33'],
            'vat' => ['required', 'numeric'],
            'country' => ['required', 'numeric', 'exists:countries,id'],
            'address' => ['required', 'string'],
            'location' => ['required', 'string'],
            'postCode' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:vendors,email'],
            'phone' => ['nullable', 'string'],
            'locations' => ['nullable', 'array'],
            'vehicles' => ['array', 'required'],

            'name' => ['required', 'string'],
            'personalPhone' => ['required', 'string'],
            'personalEmail' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(6)],
            'role' => ['required', new Enum(UserRoleEnum::class)],
            'locale' => ['required', 'string', Rule::in(config('app.locales'))],

            'agreeToTerms' => ['required', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'role' => UserRoleEnum::Customer,
            'locale' => $this->header('X-Locale', config('app.locale')),
            'locations' => $this->collect('locations')->merge([
                $this->only(['country', 'location']) + ['default' => 1],
            ])->toArray(),
        ]);
    }
}
