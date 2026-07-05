<?php
//Activa el modo estricto de tipos en PHP
declare(strict_types=1);

namespace App\Modules\Persons\Domain\Entities;

/**
 * Entidad de dominio que representa una persona.
 */

final class Person
{
     /**
     * Inicializa una instancia inmutable de la entidad Person.
     */
    public function __construct(
        public readonly ?int $id,
        public readonly string $personKey,
        public readonly string $firstName,
        public readonly ?string $secondName,
        public readonly string $firstSurname,
        public readonly ?string $secondSurname,
        public readonly ?string $birthdate,
        public readonly ?int $gender,
        public readonly ?string $genderName,
        public readonly ?int $bloodType,
        public readonly ?string $bloodTypeName,
        public readonly ?int $profession,
        public readonly ?string $professionName,
        public readonly ?string $dpi,
        public readonly ?string $nit,
        public readonly ?string $email,
        public readonly ?string $phoneNumber,
        public readonly ?string $secondaryPhoneNumber,
        public readonly ?string $address,
        public readonly int $status,
        public readonly ?string $statusName,
        public readonly ?int $createdBy,
        public readonly ?string $creationDate,
        public readonly ?int $modifiedBy,
        public readonly ?string $modificationDate,
    )
    {
    }
     /**
     * Obtiene el nombre completo de la persona concatenando
     * nombres y apellidos, ignorando los campos opcionales nulos.
     */
    public function fullName(): string
    {
        return trim(sprintf(
            '%s %s %s %s',
            $this->firstName,
            $this->secondName ?? '',
            $this->firstSurname,
            $this->secondSurname ?? ''
        ));
    }


}
