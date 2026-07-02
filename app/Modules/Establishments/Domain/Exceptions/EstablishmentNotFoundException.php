<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Exceptions;

use RuntimeException;

/**
 * Excepción lanzada cuando no se encuentra un establecimiento
 * con el identificador solicitado.
 */
final class EstablishmentNotFoundException extends RuntimeException
{
    /**
     * Crea la excepción con un mensaje que incluye el id buscado.
     */
    public function __construct(int $id)
    {
        parent::__construct("Establishment with id {$id} not found.");
    }
}
