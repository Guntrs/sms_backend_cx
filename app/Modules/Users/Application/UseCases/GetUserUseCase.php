<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Exceptions\UserNotFoundException;

final class GetUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function execute(int $id): User
    {
        $user = $this->userRepository->findById($id);

        if ($user === null) {
            throw new UserNotFoundException($id);
        }

        return $user;
    }
}
