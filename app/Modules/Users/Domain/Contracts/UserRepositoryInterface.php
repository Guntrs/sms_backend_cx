<?php

declare(strict_types=1);

namespace App\Modules\Users\Domain\Contracts;

use App\Modules\Users\Domain\Entities\User;

/**
 * Contrato del repositorio de usuarios.
 *
 * Define las operaciones que la capa Domain necesita para
 * gestionar usuarios, sin depender de una implementación
 * específica (Eloquent, SQL Server, API externa, etc.).
 *
 * La implementación concreta será responsabilidad de la
 * capa Infrastructure.
 */
interface UserRepositoryInterface
{
    /**
     * Busca un usuario por su identificador.
     *
     * @param int $id Identificador único del usuario.
     *
     * @return User|null Retorna la entidad User si existe;
     *                   de lo contrario, null.
     */
    public function findById(int $id): ?User;

    /**
     * Busca un usuario por su nombre de usuario.
     *
     * @param string $userName Nombre utilizado para iniciar sesión.
     *
     * @return User|null Retorna la entidad User si existe;
     *                   de lo contrario, null.
     */
    public function findByUserName(string $userName): ?User;

    /**
     * Busca un usuario mediante su correo electrónico.
     *
     * @param string $email Correo electrónico del usuario.
     *
     * @return User|null Retorna la entidad User si existe;
     *                   de lo contrario, null.
     */
    public function findByEmail(string $email): ?User;

    /**
     * Crea un nuevo usuario.
     *
     * @param array $data Información necesaria para crear el usuario.
     *
     * @return User Entidad del usuario creado.
     */
    public function create(array $data): User;

    /**
     * Actualiza la información de un usuario existente.
     *
     * @param int   $id   Identificador del usuario.
     * @param array $data Datos que serán actualizados.
     *
     * @return User Entidad del usuario con la información actualizada.
     */
    public function update(int $id, array $data): User;

    /**
     * Elimina un usuario.
     *
     * @param int $id Identificador del usuario.
     *
     * @return bool Indica si la operación fue exitosa.
     */
    public function delete(int $id): bool;

    /**
     * Obtiene una lista paginada de usuarios.
     *
     * @param int $perPage Cantidad de registros por página.
     *
     * @return mixed Resultado paginado de la implementación utilizada.
     */
    public function paginate(int $perPage = 15): mixed;
}
