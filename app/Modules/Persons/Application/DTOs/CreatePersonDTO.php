<?php

declare(strict_types=1);

namespace App\Modules\Persons\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Persons\Domain\Rules\PersonStatus;

final class CreatePersonDTO
{
    public function __construct(
        public readonly string $firstName,
        public readonly ?string $secondName,
        public readonly string $firstSurname,
        public readonly ?string $secondSurname,
        public readonly ?string $birthdate,
        public readonly ?int $gender,
        public readonly ?int $bloodType,
        public readonly ?int $profession,
        public readonly ?string $dpi,
        public readonly ?string $nit,
        public readonly ?string $email,
        public readonly ?string $phoneNumber,
        public readonly ?string $secondaryPhoneNumber,
        public readonly ?string $address,
        public readonly int $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            firstName: $request->validated('first_name'),
            secondName: $request->validated('second_name'),
            firstSurname: $request->validated('first_surname'),
            secondSurname: $request->validated('second_surname'),
            birthdate: $request->validated('birthdate'),
            gender: $request->validated('gender') !== null ? (int) $request->validated('gender') : null,
            bloodType: $request->validated('blood_type') !== null
                ? (int) $request->validated('blood_type')
                : null,
            profession: $request->validated('profession') !== null
                ? (int) $request->validated('profession')
                : null,
            dpi: $request->validated('dpi'),
            nit: $request->validated('nit'),
            email: $request->validated('email'),
            phoneNumber: $request->validated('phone_number'),
            secondaryPhoneNumber: $request->validated('secondary_phone_number'),
            address: $request->validated('address'),
            status: PersonStatus::ACTIVO,
        );
    }
}
