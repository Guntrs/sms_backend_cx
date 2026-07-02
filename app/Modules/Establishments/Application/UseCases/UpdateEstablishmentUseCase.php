<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este caso de uso.
namespace App\Modules\Establishments\Application\UseCases;

// Importa el DTO con los datos necesarios para actualizar un establecimiento.
use App\Modules\Establishments\Application\DTOs\UpdateEstablishmentDTO;

// Importa el contrato del repositorio para acceder a los datos.
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;

// Importa la entidad que será devuelta tras la actualización.
use App\Modules\Establishments\Domain\Entities\Establishment;

// Importa la excepción que se lanza si el establecimiento no existe.
use App\Modules\Establishments\Domain\Exceptions\EstablishmentNotFoundException;

/*
|--------------------------------------------------------------------------
| UpdateEstablishmentUseCase
|--------------------------------------------------------------------------
| Caso de uso encargado de ejecutar la lógica de negocio para actualizar
| un establecimiento existente.
*/
final class UpdateEstablishmentUseCase
{
    // Inyecta el repositorio mediante su interfaz.
    public function __construct(
        private readonly EstablishmentRepositoryInterface $establishmentRepository
    ) {}

    // Ejecuta el proceso de actualización del establecimiento.
    public function execute(int $id, UpdateEstablishmentDTO $dto): Establishment
    {
        // Busca el establecimiento por su ID.
        $existing = $this->establishmentRepository->findById($id);

        // Si no existe, detiene el proceso lanzando una excepción.
        if ($existing === null) {
            throw new EstablishmentNotFoundException($id);
        }

        // Construye el arreglo con los datos que serán actualizados.
        // Solo conserva los campos cuyo valor no sea null.
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

        // Actualiza el establecimiento y devuelve la entidad actualizada.
        return $this->establishmentRepository->update($id, $data);
    }
}
