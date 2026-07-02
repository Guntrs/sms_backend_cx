<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este caso de uso.
namespace App\Modules\Establishments\Application\UseCases;

// Importa el DTO con los datos necesarios para crear un establecimiento.
use App\Modules\Establishments\Application\DTOs\CreateEstablishmentDTO;

// Importa el contrato del repositorio para acceder a los datos.
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;

// Importa la entidad que será devuelta al finalizar la creación.
use App\Modules\Establishments\Domain\Entities\Establishment;

// Importa la excepción que se lanza si el establecimiento ya existe.
use App\Modules\Establishments\Domain\Exceptions\EstablishmentAlreadyExistsException;

/*
|--------------------------------------------------------------------------
| CreateEstablishmentUseCase
|--------------------------------------------------------------------------
| Caso de uso encargado de ejecutar la lógica de negocio para crear
| un nuevo establecimiento.
*/
final class CreateEstablishmentUseCase
{
    // Inyecta el repositorio mediante su interfaz.
    public function __construct(
        private readonly EstablishmentRepositoryInterface $establishmentRepository
    ) {}

    // Ejecuta el proceso de creación del establecimiento.
    public function execute(CreateEstablishmentDTO $dto): Establishment
    {
        // Busca si ya existe un establecimiento con el mismo nombre.
        $existing = $this->establishmentRepository->findByName($dto->establishmentName);

        // Si existe, detiene el proceso lanzando una excepción.
        if ($existing !== null) {
            throw new EstablishmentAlreadyExistsException($dto->establishmentName);
        }

        // Crea el establecimiento utilizando los datos del DTO.
        return $this->establishmentRepository->create([
            'establishment_name'        => $dto->establishmentName,
            'parent_establishment_id'   => $dto->parentEstablishmentId,
            'establishment_nit'         => $dto->establishmentNit,
            'establishment_description' => $dto->establishmentDescription,
            'establishment_address'     => $dto->establishmentAddress,
            'establishment_email'       => $dto->establishmentEmail,
            'establishment_phone'       => $dto->establishmentPhone,
            'establishment_type'        => $dto->establishmentType,
            'status'                    => $dto->status,
            'created_by'                => $dto->createdBy,
        ]);
    }
}
