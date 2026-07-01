<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Application\DTOs\UpdateUserDTO;
use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Hash;

/**
 * Caso de uso para la actualización de usuarios.
 *
 * Contiene la lógica de negocio necesaria para actualizar
 * un usuario existente, coordinando las reglas del dominio
 * y el acceso al repositorio.
 */
final class UpdateUserUseCase
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
     * Ejecuta el proceso de actualización de un usuario.
     *
     * Flujo:
     * 1. Verifica que el usuario exista.
     * 2. Si no existe, lanza una excepción de dominio.
     * 3. Construye únicamente los campos que serán actualizados.
     * 4. Encripta la contraseña si fue proporcionada.
     * 5. Solicita al repositorio actualizar el usuario.
     *
     * @param int $id Identificador del usuario.
     * @param UpdateUserDTO $dto Datos necesarios para actualizar el usuario.
     *
     * @return User Entidad del usuario actualizada.
     *
     * @throws UserNotFoundException Si el usuario no existe.
     */
    public function execute(int $id, UpdateUserDTO $dto): User
    {
        // Verifica que el usuario exista.
        $existing = $this->userRepository->findById($id);

        // Si no existe, se detiene el proceso lanzando una excepción.
        if ($existing === null) {
            throw new UserNotFoundException($id);
        }

        // Construye el arreglo únicamente con los campos enviados.
        $data = array_filter([
            'user_full_name'      => $dto->userFullName,
            'user_email'          => $dto->userEmail,
            'user_phone'          => $dto->userPhone,
            'professional_number' => $dto->professionalNumber,
            'signature'           => $dto->signature,
            'image_url'           => $dto->imageUrl,
            'status'              => $dto->status,
            'modified_by'         => $dto->modifiedBy,

            // Encripta la contraseña únicamente si fue enviada.
            'password'            => $dto->password !== null
                                        ? Hash::make($dto->password)
                                        : null,

        // Elimina los campos con valor null para evitar
        // actualizar columnas que no fueron enviadas.
        ], fn($v) => $v !== null);

        // Solicita al repositorio actualizar el usuario.
        return $this->userRepository->update($id, $data);
    }
}
