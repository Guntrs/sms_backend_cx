<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este caso de uso.
namespace App\Modules\Establishments\Application\UseCases;

// Importa el contrato del repositorio para acceder a los datos.
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;

// Importa la excepción que se lanza si el establecimiento no existe.
use App\Modules\Establishments\Domain\Exceptions\EstablishmentNotFoundException;

/*
|--------------------------------------------------------------------------
| DeleteEstablishmentUseCase
|--------------------------------------------------------------------------
| Caso de uso encargado de ejecutar la lógica de negocio para eliminar
| un establecimiento existente.
*/
final class DeleteEstablishmentUseCase
{
    // Inyecta el repositorio mediante su interfaz.
    public function __construct(
        private readonly EstablishmentRepositoryInterface $establishmentRepository
    ) {}

    // Ejecuta el proceso de eliminación del establecimiento.
    public function execute(int $id): bool
    {
        // Busca el establecimiento por su ID.
        $existing = $this->establishmentRepository->findById($id);

        // Si no existe, detiene el proceso lanzando una excepción.
        if ($existing === null) {
            throw new EstablishmentNotFoundException($id);
        }

        // Elimina el establecimiento y devuelve el resultado de la operación.
        return $this->establishmentRepository->delete($id);
    }
}
