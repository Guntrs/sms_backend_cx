<?php

declare(strict_types=1);

namespace App\Modules\Auth\Infrastructure\Repositories;

use App\Modules\Auth\Domain\Contracts\AuthRepositoryInterface;
use App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel;

// Implementación concreta del contrato AuthRepositoryInterface usando Eloquent
final class AuthEloquentRepository implements AuthRepositoryInterface
{
    // Busca usuario por user_name en sms_users
    public function findByUsername(string $username): ?SmsUserEloquentModel
    {
        return SmsUserEloquentModel::where('user_name', $username)->first();
    }

    // Busca usuario por user_id en sms_users
    public function findById(int $id): ?SmsUserEloquentModel
    {
        return SmsUserEloquentModel::find($id);
    }
}
