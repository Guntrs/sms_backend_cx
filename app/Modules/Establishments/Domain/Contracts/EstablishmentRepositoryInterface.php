<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Contracts;

use App\Modules\Establishments\Domain\Entities\Establishment;

/**
 * Define las operaciones que el dominio necesita para trabajar
 * con establecimientos.
 *
 * No indica cómo se obtienen o almacenan los datos; únicamente
 * establece qué operaciones deben existir.
 */
interface EstablishmentRepositoryInterface
{
    /** Busca un establecimiento por su identificador. */
    public function findById(int $id): ?Establishment;

    /** Busca un establecimiento por su nombre. */
    public function findByName(string $name): ?Establishment;

    /** Busca un establecimiento por su NIT. */
    public function findByNit(string $nit): ?Establishment;

    /** Crea un nuevo establecimiento. */
    public function create(array $data): Establishment;

    /** Actualiza la información de un establecimiento. */
    public function update(int $id, array $data): Establishment;

    /** Elimina un establecimiento. */
    public function delete(int $id): bool;

    /** Obtiene los establecimientos de forma paginada. */
    public function paginate(int $perPage = 15): mixed;

    /** Obtiene todos los establecimientos. */
    public function all(): mixed;
}
