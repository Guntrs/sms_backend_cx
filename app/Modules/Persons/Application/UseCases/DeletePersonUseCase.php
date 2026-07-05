<?php

declare(strict_types=1);

namespace App\Modules\Persons\Application\UseCases;

use App\Modules\Persons\Domain\Contracts\PersonRepositoryInterface;
use App\Modules\Persons\Domain\Exceptions\PersonNotFoundException;

final class DeletePersonUseCase
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {}

    public function execute(int $id): bool
    {
        $existing = $this->personRepository->findById($id);

        if (!$existing) {
            throw new PersonNotFoundException($id);
        }

        return $this->personRepository->delete($id);
    }
}
