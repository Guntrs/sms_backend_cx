<?php

declare(strict_types=1);

namespace App\Modules\Auth\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Valida y autoriza el request HTTP de login
final class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => ['required', 'string'],
            'password'  => ['required', 'string'],
        ];
    }
}
