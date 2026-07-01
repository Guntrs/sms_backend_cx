<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Application\DTOs\CreateUserDTO;
use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Exceptions\UserAlreadyExistsException;
use Illuminate\Support\Facades\Hash;

/**
 * Caso de uso para la creación de usuarios.
 *
 * Contiene la lógica de negocio necesaria para crear un usuario,
 * coordinando las reglas del dominio y el acceso al repositorio.
 */
final class CreateUserUseCase
{
    /**
     * Inicializa el caso de uso con el repositorio de usuarios.
     *
     * @param UserRepositoryInterface $userRepository Repositorio encargado
     * de consultar y persistir usuarios.
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * Ejecuta el proceso de creación de un usuario.
     *
     * Flujo:
     * 1. Verifica que el nombre de usuario no exista.
     * 2. Si ya existe, lanza una excepción de dominio.
     * 3. Encripta la contraseña.
     * 4. Solicita al repositorio crear el nuevo usuario.
     *
     * @param CreateUserDTO $dto Datos necesarios para crear el usuario.
     *
     * @return User Entidad del usuario creado.
     *
     * @throws UserAlreadyExistsException Si el nombre de usuario ya existe.
     */
    public function execute(CreateUserDTO $dto): User
    {
        // Verifica si ya existe un usuario con el mismo nombre.
        $existing = $this->userRepository->findByUserName($dto->userName);

        // Si existe, se detiene el proceso lanzando una excepción.
        if ($existing !== null) {
            throw new UserAlreadyExistsException($dto->userName);
        }

        // Solicita al repositorio crear el nuevo usuario.
        return $this->userRepository->create([
            'person_id'           => $dto->personId,
            'user_name'           => $dto->userName,

            // Encripta la contraseña antes de almacenarla.
            'password'            => Hash::make($dto->password),

            'parent_user_id'      => $dto->parentUserId,
            'user_full_name'      => $dto->userFullName,
            'user_email'          => $dto->userEmail,
            'user_phone'          => $dto->userPhone,
            'professional_number' => $dto->professionalNumber,
            'signature'           => $dto->signature,
            'image_url'           => $dto->imageUrl,
            'status'              => $dto->status,
            'created_by'          => $dto->createdBy,
        ]);
    }
}
