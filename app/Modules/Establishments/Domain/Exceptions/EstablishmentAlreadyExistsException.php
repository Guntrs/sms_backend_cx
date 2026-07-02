<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Exceptions;

use RuntimeException;

/**
 * Excepción lanzada cuando se intenta crear un establecimiento
 * que ya existe.
 */
final class EstablishmentAlreadyExistsException extends RuntimeException
{
    /**
     * Crea la excepción con el nombre del establecimiento duplicado.
     */
    public function __construct(string $name)
    {
        parent::__construct("Establishment with name '{$name}' already exists.");
    }
}
