<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Presentation\Controllers;

use App\Core\BaseController;
use App\Modules\Establishments\Application\DTOs\CreateEstablishmentDTO;
use App\Modules\Establishments\Application\DTOs\UpdateEstablishmentDTO;
use App\Modules\Establishments\Application\UseCases\CreateEstablishmentUseCase;
use App\Modules\Establishments\Application\UseCases\DeleteEstablishmentUseCase;
use App\Modules\Establishments\Application\UseCases\GetEstablishmentUseCase;
use App\Modules\Establishments\Application\UseCases\ListEstablishmentsUseCase;
use App\Modules\Establishments\Application\UseCases\UpdateEstablishmentUseCase;
use App\Modules\Establishments\Domain\Exceptions\EstablishmentAlreadyExistsException;
use App\Modules\Establishments\Domain\Exceptions\EstablishmentNotFoundException;
use App\Modules\Establishments\Domain\Exceptions\InvalidEstablishmentStatusException;
use App\Modules\Establishments\Domain\Exceptions\InvalidEstablishmentTypeException;
use App\Modules\Establishments\Presentation\Requests\CreateEstablishmentRequest;
use App\Modules\Establishments\Presentation\Requests\UpdateEstablishmentRequest;
use App\Modules\Establishments\Presentation\Resources\EstablishmentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Controlador encargado de recibir las peticiones HTTP
 * relacionadas con los establecimientos.
 *
 * Su responsabilidad es coordinar el flujo entre la
 * capa de Presentación y los casos de uso, sin contener
 * lógica de negocio.
 */
final class EstablishmentController extends BaseController
{
    /**
     * Inyecta los casos de uso necesarios para
     * gestionar los establecimientos.
     */
    public function __construct(
        private readonly CreateEstablishmentUseCase $createEstablishmentUseCase,
        private readonly UpdateEstablishmentUseCase $updateEstablishmentUseCase,
        private readonly DeleteEstablishmentUseCase $deleteEstablishmentUseCase,
        private readonly GetEstablishmentUseCase    $getEstablishmentUseCase,
        private readonly ListEstablishmentsUseCase  $listEstablishmentsUseCase,
    ) {}

    /**
     * Obtiene el listado de establecimientos.
     */
    public function index(): AnonymousResourceCollection
    {
        $establishments = $this->listEstablishmentsUseCase->execute();

        return EstablishmentResource::collection($establishments);
    }

    /**
     * Crea un nuevo establecimiento.
     */
    public function store(CreateEstablishmentRequest $request): JsonResponse
    {
        try {
            // Convierte la petición validada en un DTO.
            $dto = CreateEstablishmentDTO::fromRequest($request);

            // Ejecuta el caso de uso.
            $establishment = $this->createEstablishmentUseCase->execute($dto);

            // Devuelve la respuesta exitosa.
            return $this->successResponse(
                new EstablishmentResource($establishment),
                'Establishment created successfully',
                201
            );

        } catch (EstablishmentAlreadyExistsException $e) {

            // El establecimiento ya existe.
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Obtiene un establecimiento por su identificador.
     */
    public function show(int $establishment): JsonResponse
    {
        try {
            // Ejecuta el caso de uso.
            $entity = $this->getEstablishmentUseCase->execute($establishment);

            return $this->successResponse(
                new EstablishmentResource($entity)
            );

        } catch (EstablishmentNotFoundException $e) {

            // El establecimiento no fue encontrado.
            return $this->errorResponse($e->getMessage(), 404);
        }
    }

    /**
     * Actualiza un establecimiento existente.
     */
    public function update(UpdateEstablishmentRequest $request, int $establishment): JsonResponse
    {
        try {
            // Convierte la petición validada en un DTO.
            $dto = UpdateEstablishmentDTO::fromRequest($request);

            // Ejecuta el caso de uso.
            $entity = $this->updateEstablishmentUseCase->execute($establishment, $dto);

            return $this->successResponse(
                new EstablishmentResource($entity),
                'Establishment updated successfully'
            );

        } catch (EstablishmentNotFoundException $e) {

            // El establecimiento no existe.
            return $this->errorResponse($e->getMessage(), 404);

        } catch (InvalidEstablishmentStatusException $e) {

            // El estado enviado no es válido.
            return $this->errorResponse($e->getMessage(), 422);

        } catch (InvalidEstablishmentTypeException $e) {

            // El tipo de establecimiento enviado no es válido.
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Elimina un establecimiento.
     */
    public function destroy(int $establishment): JsonResponse
    {
        try {
            // Ejecuta el caso de uso.
            $this->deleteEstablishmentUseCase->execute($establishment);

            return $this->successResponse(
                null,
                'Establishment deleted successfully'
            );

        } catch (EstablishmentNotFoundException $e) {

            // El establecimiento no existe.
            return $this->errorResponse($e->getMessage(), 404);
        }
    }
}
