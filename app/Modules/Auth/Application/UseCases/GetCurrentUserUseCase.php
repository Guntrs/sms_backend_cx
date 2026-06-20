<?php

declare(strict_types=1);

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Auth\Domain\Contracts\AuthRepositoryInterface;
use App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel;

// Retorna el usuario autenticado actual
final class GetCurrentUserUseCase
{
    public function __construct(
        private readonly AuthRepositoryInterface $authRepository,
    ) {}

    public function execute(int $userId): ?SmsUserEloquentModel
    {
        return $this->authRepository->findById($userId);
    }
}
