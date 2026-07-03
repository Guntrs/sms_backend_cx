<?php

declare(strict_types=1);

namespace App\Modules\Users\Domain\Exceptions;

use DomainException;

/**
 * Excepción lanzada cuando se intenta asignar
 * un status inválido a un usuario.
 */
final class InvalidUserStatusException extends DomainException
{
    public function __construct(int $status)
    {
        parent::__construct(
            "El status [{$status}] no es válido para un usuario. Valores permitidos: 501 (Activo), 502 (Inactivo), 503 (Suspendido)."
        );
    }
}
