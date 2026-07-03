<?php

declare(strict_types=1);

namespace App\Modules\Users\Presentation\Controllers;

use App\Core\BaseController;
use App\Modules\Users\Application\DTOs\CreateUserDTO;
use App\Modules\Users\Application\DTOs\UpdateUserDTO;
use App\Modules\Users\Application\UseCases\CreateUserUseCase;
use App\Modules\Users\Application\UseCases\DeleteUserUseCase;
use App\Modules\Users\Application\UseCases\GetUserUseCase;
use App\Modules\Users\Application\UseCases\ListUsersUseCase;
use App\Modules\Users\Application\UseCases\UpdateUserUseCase;
use App\Modules\Users\Domain\Exceptions\InvalidUserStatusException;
use App\Modules\Users\Domain\Exceptions\UserAlreadyExistsException;
use App\Modules\Users\Domain\Exceptions\UserNotFoundException;
use App\Modules\Users\Presentation\Requests\CreateUserRequest;
use App\Modules\Users\Presentation\Requests\UpdateUserRequest;
use App\Modules\Users\Presentation\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Controlador del módulo de usuarios.
 *
 * Recibe las peticiones HTTP, coordina los casos de uso
 * de la aplicación y devuelve las respuestas al cliente.
 *
 * No contiene lógica de negocio; únicamente orquesta
 * el flujo entre Presentation y Application.
 */
final class UserController extends BaseController
{
    /**
     * Inicializa el controlador con los casos de uso necesarios.
     */
    public function __construct(
        private readonly CreateUserUseCase $createUserUseCase,
        private readonly UpdateUserUseCase $updateUserUseCase,
        private readonly DeleteUserUseCase $deleteUserUseCase,
        private readonly GetUserUseCase    $getUserUseCase,
        private readonly ListUsersUseCase  $listUsersUseCase,
    ) {}

    /**
     * Obtiene el listado de usuarios.
     *
     * Flujo:
     * 1. Ejecuta el caso de uso para listar usuarios.
     * 2. Convierte cada entidad en un Resource.
     * 3. Devuelve la colección al cliente.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        // Obtiene el listado de usuarios.
        $users = $this->listUsersUseCase->execute();

        // Convierte las entidades en recursos JSON.
        return UserResource::collection($users);
    }

    /**
     * Crea un nuevo usuario.
     *
     * Flujo:
     * 1. Recibe un Request validado.
     * 2. Lo convierte en un DTO.
     * 3. Ejecuta el caso de uso.
     * 4. Devuelve el usuario creado.
     *
     * @param CreateUserRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        try {

            // Convierte el Request en un DTO.
            $dto = CreateUserDTO::fromRequest($request);

            // Ejecuta la lógica de negocio.
            $user = $this->createUserUseCase->execute($dto);

            // Devuelve el usuario creado.
            return $this->successResponse(
                new UserResource($user),
                'User created successfully',
                201
            );

        } catch (UserAlreadyExistsException $e) {

            // Devuelve un error si el usuario ya existe.
            return $this->errorResponse(
                $e->getMessage(),
                422
            );
        }
    }

    /**
     * Obtiene un usuario por su identificador.
     *
     * Flujo:
     * 1. Ejecuta el caso de uso.
     * 2. Devuelve el usuario encontrado.
     *
     * @param int $user
     *
     * @return JsonResponse
     */
    public function show(int $user): JsonResponse
    {
        try {

            // Obtiene la entidad.
            $entity = $this->getUserUseCase->execute($user);

            // Devuelve el usuario.
            return $this->successResponse(
                new UserResource($entity)
            );

        } catch (UserNotFoundException $e) {

            // Devuelve un error si el usuario no existe.
            return $this->errorResponse(
                $e->getMessage(),
                404
            );
        }
    }

    /**
     * Actualiza un usuario existente.
     *
     * Flujo:
     * 1. Recibe un Request validado.
     * 2. Lo convierte en un DTO.
     * 3. Ejecuta el caso de uso.
     * 4. Devuelve el usuario actualizado.
     *
     * @param UpdateUserRequest $request
     * @param int $user
     *
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $user): JsonResponse
    {
        try {

            // Convierte el Request en un DTO.
            $dto = UpdateUserDTO::fromRequest($request);

            // Ejecuta la lógica de negocio.
            $entity = $this->updateUserUseCase->execute($user, $dto);

            // Devuelve el usuario actualizado.
            return $this->successResponse(
                new UserResource($entity),
                'User updated successfully'
            );

        } catch (UserNotFoundException $e) {

            // Devuelve un error si el usuario no existe.
            return $this->errorResponse(
                $e->getMessage(),
                404
            );

        } catch (InvalidUserStatusException $e) {

            // Devuelve un error si el status enviado no es válido
            // (solo se permiten 501 Activo, 502 Inactivo, 503 Suspendido).
            return $this->errorResponse(
                $e->getMessage(),
                422
            );
        }
    }

    /**
     * Elimina un usuario.
     *
     * Flujo:
     * 1. Ejecuta el caso de uso.
     * 2. Devuelve una respuesta de éxito.
     *
     * @param int $user
     *
     * @return JsonResponse
     */
    public function destroy(int $user): JsonResponse
    {
        try {

            // Ejecuta la eliminación.
            $this->deleteUserUseCase->execute($user);

            // Devuelve una respuesta exitosa.
            return $this->successResponse(
                null,
                'User deleted successfully'
            );

        } catch (UserNotFoundException $e) {

            // Devuelve un error si el usuario no existe.
            return $this->errorResponse(
                $e->getMessage(),
                404
            );
        }
    }
}
