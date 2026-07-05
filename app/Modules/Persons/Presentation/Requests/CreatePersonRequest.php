<?php

declare(strict_types=1);

namespace App\Modules\Persons\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Persons\Domain\Rules\PersonGender;
use App\Modules\Persons\Domain\Rules\PersonBloodType;
use App\Modules\Persons\Domain\Rules\PersonProfession;
use Illuminate\Validation\Rule;

final class CreatePersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'second_name' => ['nullable', 'string', 'max:100'],
            'first_surname' => ['required', 'string', 'max:100'],
            'second_surname' => ['nullable', 'string', 'max:100'],
            'birthdate' => ['nullable', 'date'],
            'gender' => ['nullable', 'integer', Rule::in(PersonGender::values())],
            'blood_type' => ['nullable', 'integer', Rule::in(PersonBloodType::values())],
            'profession' => ['nullable', 'integer', Rule::in(PersonProfession::values())],
            'dpi' => ['nullable', 'string', 'max:20'],
            'nit' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'secondary_phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            // status NO se valida aquí: se fija automáticamente en el DTO (ACTIVO = 501)
        ];
    }
}
