<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Exceptions;

use DomainException;

final class InvalidEstablishmentTypeException extends DomainException
{
    public function __construct(int $type)
    {
        parent::__construct(
            "El establishment_type [{$type}] no es válido. Valores permitidos: 221 (Tecnologia), 222 (Comercio), 223 (Servicios), 224 (Administracion), 225 (Publico), 226 (Salud)."
        );
    }
}
