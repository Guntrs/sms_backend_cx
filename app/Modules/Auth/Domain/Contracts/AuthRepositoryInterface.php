<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Contracts;

use App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel;

// Contrato que define qué operaciones de datos necesita el módulo Auth.
// Domain solo conoce esta interfaz, NUNCA la implementación concreta.
interface AuthRepositoryInterface
{
    // Busca usuario por user_name — usado en Login
    public function findByUsername(string $username): ?SmsUserEloquentModel;

    // Busca usuario por user_id — usado en GetCurrentUser
    public function findById(int $id): ?SmsUserEloquentModel;
}
