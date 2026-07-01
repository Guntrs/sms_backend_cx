<?php

declare(strict_types=1);

namespace App\Modules\Users\Domain\Exceptions;

use RuntimeException;

/**
 * Excepción de dominio para usuarios no encontrados.
 *
 * Se lanza cuando se intenta obtener un usuario que no
 * existe dentro del dominio de la aplicación.
 *
 * Al crear una excepción específica, el dominio puede
 * comunicar este tipo de error de forma clara y permitir
 * que otras capas (Application o Presentation) decidan
 * cómo manejarlo.
 */
final class UserNotFoundException extends RuntimeException
{
    /**
     * Inicializa la excepción con el identificador del usuario.
     *
     * @param int $id Identificador del usuario que no fue encontrado.
     */
    public function __construct(int $id)
    {
        parent::__construct("User with id {$id} not found.");
    }
}
