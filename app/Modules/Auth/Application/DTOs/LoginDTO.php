<?php

declare(strict_types=1);

namespace App\Modules\Auth\Application\DTOs;

use Illuminate\Http\Request;

// Objeto inmutable que transporta los datos del request de login a los UseCases
final class LoginDTO
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
    ) {}

    // Construye el DTO desde el request HTTP validado
    public static function fromRequest(Request $request): self
    {
        return new self(
            username: $request->validated('user_name'),
            password: $request->validated('password'),
        );
    }
}
