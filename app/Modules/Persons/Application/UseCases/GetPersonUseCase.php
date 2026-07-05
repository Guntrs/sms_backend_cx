<?php

declare(strict_types=1);

namespace App\Modules\Persons\Application\UseCases;

use App\Modules\Persons\Domain\Contracts\PersonRepositoryInterface;
use App\Modules\Persons\Domain\Entities\Person;
use App\Modules\Persons\Domain\Exceptions\PersonNotFoundException;

final class GetPersonUseCase
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {}

    public function execute(int $id): Person
    {
        $person = $this->personRepository->findById($id);

        if (!$person) {
            throw new PersonNotFoundException($id);
        }

        return $person;
    }
}
