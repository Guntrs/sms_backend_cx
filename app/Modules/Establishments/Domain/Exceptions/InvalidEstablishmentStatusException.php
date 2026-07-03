<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Exceptions;

use DomainException;

final class InvalidEstablishmentStatusException extends DomainException
{
    public function __construct(int $status)
    {
        parent::__construct(
            "El status [{$status}] no es válido para un establecimiento. Valores permitidos: 501 (Activo), 502 (Inactivo), 503 (Suspendido)."
        );
    }
}
