<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este caso de uso.
namespace App\Modules\Establishments\Application\UseCases;

// Importa el contrato del repositorio para acceder a los datos.
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;

/*
|--------------------------------------------------------------------------
| ListEstablishmentsUseCase
|--------------------------------------------------------------------------
| Caso de uso encargado de obtener una lista paginada de establecimientos.
*/
final class ListEstablishmentsUseCase
{
    // Inyecta el repositorio mediante su interfaz.
    public function __construct(
        private readonly EstablishmentRepositoryInterface $establishmentRepository
    ) {}

    // Ejecuta la consulta y devuelve los establecimientos paginados.
    public function execute(int $perPage = 15): mixed
    {
        // Solicita al repositorio la lista paginada de establecimientos.
        return $this->establishmentRepository->paginate($perPage);
    }
}
