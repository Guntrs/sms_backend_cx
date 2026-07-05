<?php

declare(strict_types=1);

namespace App\Modules\Persons\Application\UseCases;

use App\Modules\Persons\Application\DTOs\UpdatePersonDTO;
use App\Modules\Persons\Domain\Contracts\PersonRepositoryInterface;
use App\Modules\Persons\Domain\Entities\Person;
use App\Modules\Persons\Domain\Rules\PersonStatus;
use App\Modules\Persons\Domain\Rules\PersonGender;
use App\Modules\Persons\Domain\Rules\PersonBloodType;
use App\Modules\Persons\Domain\Rules\PersonProfession;
use App\Modules\Persons\Domain\Exceptions\PersonNotFoundException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonStatusException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonGenderException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonBloodTypeException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonProfessionException;

final class UpdatePersonUseCase
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {}

    public function execute(int $id, UpdatePersonDTO $dto): Person
    {
        $existing = $this->personRepository->findById($id);

        if (!$existing) {
            throw new PersonNotFoundException($id);
        }

        if ($dto->status !== null && !in_array($dto->status, PersonStatus::values(), true)) {
            throw new InvalidPersonStatusException($dto->status);
        }

        if ($dto->gender !== null && !in_array($dto->gender, PersonGender::values(), true)) {
            throw new InvalidPersonGenderException($dto->gender);
        }

        if ($dto->bloodType !== null && !in_array($dto->bloodType, PersonBloodType::values(), true)) {
            throw new InvalidPersonBloodTypeException($dto->bloodType);
        }

        if ($dto->profession !== null && !in_array($dto->profession, PersonProfession::values(), true)) {
            throw new InvalidPersonProfessionException($dto->profession);
        }

        $data = array_filter([
            'first_name' => $dto->firstName,
            'second_name' => $dto->secondName,
            'first_surname' => $dto->firstSurname,
            'second_surname' => $dto->secondSurname,
            'birthdate' => $dto->birthdate,
            'gender' => $dto->gender,
            'blood_type' => $dto->bloodType,
            'profession' => $dto->profession,
            'dpi' => $dto->dpi,
            'nit' => $dto->nit,
            'email' => $dto->email,
            'phone_number' => $dto->phoneNumber,
            'secondary_phone_number' => $dto->secondaryPhoneNumber,
            'address' => $dto->address,
            'status' => $dto->status,
        ], fn ($value) => $value !== null);

        return $this->personRepository->update($id, $data);
    }
}
