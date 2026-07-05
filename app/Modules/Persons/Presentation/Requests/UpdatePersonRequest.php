<?php

declare(strict_types=1);

namespace App\Modules\Persons\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Persons\Domain\Rules\PersonStatus;
use App\Modules\Persons\Domain\Rules\PersonGender;
use App\Modules\Persons\Domain\Rules\PersonBloodType;
use App\Modules\Persons\Domain\Rules\PersonProfession;
use Illuminate\Validation\Rule;

final class UpdatePersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'string', 'max:100'],
            'second_name' => ['sometimes', 'nullable', 'string', 'max:100'],
            'first_surname' => ['sometimes', 'string', 'max:100'],
            'second_surname' => ['sometimes', 'nullable', 'string', 'max:100'],
            'birthdate' => ['sometimes', 'nullable', 'date'],
            'gender' => ['sometimes', 'integer', Rule::in(PersonGender::values())],
            'blood_type' => ['sometimes', 'nullable', 'integer', Rule::in(PersonBloodType::values())],
            'profession' => ['sometimes', 'nullable', 'integer', Rule::in(PersonProfession::values())],
            'dpi' => ['sometimes', 'nullable', 'string', 'max:20'],
            'nit' => ['sometimes', 'nullable', 'string', 'max:20'],
            'email' => ['sometimes', 'nullable', 'email', 'max:150'],
            'phone_number' => ['sometimes', 'nullable', 'string', 'max:20'],
            'secondary_phone_number' => ['sometimes', 'nullable', 'string', 'max:20'],
            'address' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'integer', Rule::in(PersonStatus::values())],
        ];
    }
}
