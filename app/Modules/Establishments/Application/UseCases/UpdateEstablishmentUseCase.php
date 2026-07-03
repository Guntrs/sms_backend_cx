<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Application\UseCases;

use App\Modules\Establishments\Application\DTOs\UpdateEstablishmentDTO;
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;
use App\Modules\Establishments\Domain\Entities\Establishment;
use App\Modules\Establishments\Domain\Exceptions\EstablishmentNotFoundException;
use App\Modules\Establishments\Domain\Exceptions\InvalidEstablishmentStatusException;
use App\Modules\Establishments\Domain\Exceptions\InvalidEstablishmentTypeException;
use App\Modules\Establishments\Domain\Rules\EstablishmentStatus;
use App\Modules\Establishments\Domain\Rules\EstablishmentType;

final class UpdateEstablishmentUseCase
{
    public function __construct(
        private readonly EstablishmentRepositoryInterface $establishmentRepository
    ) {}

    public function execute(int $id, UpdateEstablishmentDTO $dto): Establishment
    {
        $existing = $this->establishmentRepository->findById($id);

        if ($existing === null) {
            throw new EstablishmentNotFoundException($id);
        }

        // Regla de negocio: si se envía status, debe ser uno de los permitidos.
        if ($dto->status !== null && !in_array($dto->status, EstablishmentStatus::values(), true)) {
            throw new InvalidEstablishmentStatusException($dto->status);
        }

        // Regla de negocio: si se envía establishment_type, debe ser un sector válido.
        if ($dto->establishmentType !== null && !in_array($dto->establishmentType, EstablishmentType::values(), true)) {
            throw new InvalidEstablishmentTypeException($dto->establishmentType);
        }

        $data = array_filter([
            'establishment_name'        => $dto->establishmentName,
            'parent_establishment_id'   => $dto->parentEstablishmentId,
            'establishment_nit'         => $dto->establishmentNit,
            'establishment_description' => $dto->establishmentDescription,
            'establishment_address'     => $dto->establishmentAddress,
            'establishment_email'       => $dto->establishmentEmail,
            'establishment_phone'       => $dto->establishmentPhone,
            'establishment_type'        => $dto->establishmentType,
            'status'                    => $dto->status,
            'modified_by'               => $dto->modifiedBy,
        ], fn($v) => $v !== null);

        return $this->establishmentRepository->update($id, $data);
    }
}
