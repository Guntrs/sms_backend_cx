<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Domain\Exceptions\UserNotFoundException;

/**
 * Caso de uso para la eliminación de usuarios.
 *
 * Contiene la lógica de negocio necesaria para eliminar
 * un usuario existente, coordinando las reglas del dominio
 * y el acceso al repositorio.
 */
final class DeleteUserUseCase
{
    /**
     * Inicializa el caso de uso con el repositorio de usuarios.
     *
     * @param UserRepositoryInterface $userRepository Repositorio encargado
     * de consultar y eliminar usuarios.
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * Ejecuta el proceso de eliminación de un usuario.
     *
     * Flujo:
     * 1. Verifica que el usuario exista.
     * 2. Si no existe, lanza una excepción de dominio.
     * 3. Solicita al repositorio eliminar el usuario.
     *
     * @param int $id Identificador del usuario.
     *
     * @return bool Indica si la eliminación fue exitosa.
     *
     * @throws UserNotFoundException Si el usuario no existe.
     */
    public function execute(int $id): bool
    {
        // Verifica que el usuario exista.
        $existing = $this->userRepository->findById($id);

        // Si no existe, se detiene el proceso lanzando una excepción.
        if ($existing === null) {
            throw new UserNotFoundException($id);
        }

        // Solicita al repositorio eliminar el usuario.
        return $this->userRepository->delete($id);
    }
}
