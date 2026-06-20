<?php

declare(strict_types=1);

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Auth\Application\DTOs\LoginDTO;
use App\Modules\Auth\Domain\Contracts\AuthRepositoryInterface;
use App\Modules\Auth\Domain\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Hash;

// Orquesta el proceso de login: valida credenciales y genera token
final class LoginUseCase
{
    public function __construct(
        private readonly AuthRepositoryInterface $authRepository,
    ) {}

    public function execute(LoginDTO $dto): array
    {
        // Busca el usuario por user_name
        $user = $this->authRepository->findByUsername($dto->username);

        // Si no existe o la contraseña no coincide, lanza excepción
        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        // Revoca tokens anteriores y genera uno nuevo
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
