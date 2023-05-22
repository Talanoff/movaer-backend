<?php

namespace App\Http\Requests\Questionnaire;

use App\Enums\UserRoleEnum;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class CustomerBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'category' => ['required', 'in:one,many,pallets,various'],
            'pieces' => ['required', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'dateFrom' => ['required', 'date'],
            'dateTo' => ['required', 'date'],
            'locationFrom' => ['required', 'string'],
            'locationTo' => ['required', 'string'],
            'selectLocationFrom' => ['required', 'int'],
            'selectLocationTo' => ['required', 'int'],
            'message' => ['nullable', 'string'],
            'goods' => ['nullable', 'string'],

            'wishes' => ['nullable', 'array'],
            'additionalWishes' => ['nullable', 'array'],
            'additionalWishesNotes' => ['nullable', 'string'],
            'additionalWishesAttachment' => ['nullable', 'array'],
            'additionalWishesAttachment.*' => ['nullable', 'string'],

            'role' => ['required', new Enum(UserRoleEnum::class)],
            'locale' => ['required', 'string', Rule::in(config('app.locales'))],
        ];

        if (! Auth::guard('sanctum')->check()) {
            $rules = array_merge($rules, [
                'name' => ['required', 'string', 'max:191'],
                'email' => ['required', 'email', 'max:191'],
                'phone' => ['required', 'string', 'max:20'],
                'agreeToTerms' => ['required', 'boolean'],
                'registrationRequired' => ['boolean'],
            ]);
        }

        if ($this->boolean('registrationRequired')) {
            $rules = array_merge($rules, [
                'name' => ['required', 'string', 'max:191'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required', 'string', 'max:20'],
                'password' => ['required', Password::defaults()],
            ]);
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'role' => UserRoleEnum::Customer,
            'locale' => $this->header('X-Locale', config('app.locale')),
        ]);
    }
}
