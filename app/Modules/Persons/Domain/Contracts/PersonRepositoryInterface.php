<?php
// Define el contrato que debe cumplir cualquier implementación del repositorio,
//permitiendo que el dominio dependa de una abstracción
//y no de una tecnología específica como Eloquent.

// activa el modo estricto de tipos en PHP
declare(strict_types=1);

namespace App\Modules\Persons\Domain\Contracts;

use App\Modules\Persons\Domain\Entities\Person;

/**
 * Contrato que define las operaciones que cualquier
 * repositorio de personas debe implementar.
 */
interface PersonRepositoryInterface
{
    /**
     * Busca una persona por su identificador.
     */
    public function findById(int $id): ?Person;

    /**
     * Busca una persona por su DPI.
     */
    public function findByDpi(string $dpi): ?Person;

    /**
     * Busca una persona por su correo electrónico.
     */
    public function findByEmail(string $email): ?Person;

    /**
     * Crea una nueva persona y devuelve la entidad creada.
     */
    public function create(array $data): Person;

    /**
     * Actualiza una persona existente y devuelve la entidad actualizada.
     */
    public function update(int $id, array $data): Person;

    /**
     * Elimina una persona por su identificador.
     */
    public function delete(int $id): bool;

    /**
     * Obtiene un listado paginado de personas.
     */
    public function paginate(int $perPage = 15): mixed;
}

