<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este caso de uso.
namespace App\Modules\Establishments\Application\UseCases;

// Importa el contrato del repositorio para acceder a los datos.
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;

// Importa la entidad que será devuelta.
use App\Modules\Establishments\Domain\Entities\Establishment;

// Importa la excepción que se lanza si el establecimiento no existe.
use App\Modules\Establishments\Domain\Exceptions\EstablishmentNotFoundException;

/*
|--------------------------------------------------------------------------
| GetEstablishmentUseCase
|--------------------------------------------------------------------------
| Caso de uso encargado de obtener un establecimiento por su ID.
*/
final class GetEstablishmentUseCase
{
    // Inyecta el repositorio mediante su interfaz.
    public function __construct(
        private readonly EstablishmentRepositoryInterface $establishmentRepository
    ) {}

    // Ejecuta la búsqueda del establecimiento.
    public function execute(int $id): Establishment
    {
        // Busca el establecimiento por su ID.
        $establishment = $this->establishmentRepository->findById($id);

        // Si no existe, detiene el proceso lanzando una excepción.
        if ($establishment === null) {
            throw new EstablishmentNotFoundException($id);
        }

        // Devuelve el establecimiento encontrado.
        return $establishment;
    }
}
