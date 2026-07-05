<?php

declare(strict_types=1);

namespace App\Modules\Persons\Application\UseCases;

use App\Modules\Persons\Domain\Contracts\PersonRepositoryInterface;

final class ListPersonsUseCase
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {}

    public function execute(int $perPage = 15): mixed
    {
        return $this->personRepository->paginate($perPage);
    }
}
