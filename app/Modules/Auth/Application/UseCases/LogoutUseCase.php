<?php

declare(strict_types=1);

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel;

// Revoca el token actual del usuario autenticado
final class LogoutUseCase
{
    public function execute(SmsUserEloquentModel $user): void
    {
        // Elimina solo el token con el que hizo la petición
        $user->currentAccessToken()->delete();
    }
}
