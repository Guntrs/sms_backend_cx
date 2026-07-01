<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;

final class ListUsersUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function execute(int $perPage = 15): mixed
    {
        return $this->userRepository->paginate($perPage);
    }
}
