<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este controlador.
namespace App\Modules\Establishments\Presentation\Controllers;

// Importa el controlador base de la aplicación.
use App\Core\BaseController;

// Importa los DTO utilizados para crear y actualizar establecimientos.
use App\Modules\Establishments\Application\DTOs\CreateEstablishmentDTO;
use App\Modules\Establishments\Application\DTOs\UpdateEstablishmentDTO;

// Importa los casos de uso del módulo.
use App\Modules\Establishments\Application\UseCases\CreateEstablishmentUseCase;
use App\Modules\Establishments\Application\UseCases\DeleteEstablishmentUseCase;
use App\Modules\Establishments\Application\UseCases\GetEstablishmentUseCase;
use App\Modules\Establishments\Application\UseCases\ListEstablishmentsUseCase;
use App\Modules\Establishments\Application\UseCases\UpdateEstablishmentUseCase;

// Importa las excepciones del dominio.
use App\Modules\Establishments\Domain\Exceptions\EstablishmentAlreadyExistsException;
use App\Modules\Establishments\Domain\Exceptions\EstablishmentNotFoundException;

// Importa los FormRequest para validar las solicitudes.
use App\Modules\Establishments\Presentation\Requests\CreateEstablishmentRequest;
use App\Modules\Establishments\Presentation\Requests\UpdateEstablishmentRequest;

// Importa el Resource para transformar la respuesta.
use App\Modules\Establishments\Presentation\Resources\EstablishmentResource;

// Importa las clases de respuesta HTTP.
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/*
|--------------------------------------------------------------------------
| EstablishmentController
|--------------------------------------------------------------------------
| Controlador encargado de recibir las solicitudes HTTP, delegarlas
| a los casos de uso y devolver la respuesta al cliente.
*/
final class EstablishmentController extends BaseController
{
    // Inyecta todos los casos de uso del módulo.
    public function __construct(
        private readonly CreateEstablishmentUseCase $createEstablishmentUseCase,
        private readonly UpdateEstablishmentUseCase $updateEstablishmentUseCase,
        private readonly DeleteEstablishmentUseCase $deleteEstablishmentUseCase,
        private readonly GetEstablishmentUseCase    $getEstablishmentUseCase,
        private readonly ListEstablishmentsUseCase  $listEstablishmentsUseCase,
    ) {}

    // Obtiene la lista de establecimientos.
    public function index(): AnonymousResourceCollection
    {
        // Ejecuta el caso de uso para listar establecimientos.
        $establishments = $this->listEstablishmentsUseCase->execute();

        // Devuelve la colección transformada en formato JSON.
        return EstablishmentResource::collection($establishments);
    }

    // Crea un nuevo establecimiento.
    public function store(CreateEstablishmentRequest $request): JsonResponse
    {
        try {
            // Convierte el Request validado en un DTO.
            $dto = CreateEstablishmentDTO::fromRequest($request);

            // Ejecuta el caso de uso de creación.
            $establishment = $this->createEstablishmentUseCase->execute($dto);

            // Devuelve una respuesta exitosa.
            return $this->successResponse(
                new EstablishmentResource($establishment),
                'Establishment created successfully',
                201
            );

        } catch (EstablishmentAlreadyExistsException $e) {

            // Devuelve un error si el establecimiento ya existe.
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    // Obtiene un establecimiento por su ID.
    public function show(int $establishment): JsonResponse
    {
        try {
            // Ejecuta el caso de uso de búsqueda.
            $entity = $this->getEstablishmentUseCase->execute($establishment);

            // Devuelve el establecimiento encontrado.
            return $this->successResponse(
                new EstablishmentResource($entity)
            );

        } catch (EstablishmentNotFoundException $e) {

            // Devuelve un error si el establecimiento no existe.
            return $this->errorResponse($e->getMessage(), 404);
        }
    }

    // Actualiza un establecimiento existente.
    public function update(UpdateEstablishmentRequest $request, int $establishment): JsonResponse
    {
        try {
            // Convierte el Request validado en un DTO.
            $dto = UpdateEstablishmentDTO::fromRequest($request);

            // Ejecuta el caso de uso de actualización.
            $entity = $this->updateEstablishmentUseCase->execute($establishment, $dto);

            // Devuelve la entidad actualizada.
            return $this->successResponse(
                new EstablishmentResource($entity),
                'Establishment updated successfully'
            );

        } catch (EstablishmentNotFoundException $e) {

            // Devuelve un error si el establecimiento no existe.
            return $this->errorResponse($e->getMessage(), 404);
        }
    }

    // Elimina un establecimiento por su ID.
    public function destroy(int $establishment): JsonResponse
    {
        try {
            // Ejecuta el caso de uso de eliminación.
            $this->deleteEstablishmentUseCase->execute($establishment);

            // Devuelve una respuesta exitosa.
            return $this->successResponse(
                null,
                'Establishment deleted successfully'
            );

        } catch (EstablishmentNotFoundException $e) {

            // Devuelve un error si el establecimiento no existe.
            return $this->errorResponse($e->getMessage(), 404);
        }
    }
}
