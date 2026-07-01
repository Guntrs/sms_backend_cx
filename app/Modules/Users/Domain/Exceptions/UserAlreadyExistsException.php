<?php

declare(strict_types=1);

namespace App\Modules\Users\Domain\Exceptions;

use RuntimeException;

/**
 * Excepción de dominio para usuarios ya existentes.
 *
 * Se lanza cuando se intenta crear un usuario con un
 * nombre de usuario que ya existe en el sistema.
 *
 * Al crear una excepción específica, el dominio puede
 * comunicar este tipo de error de forma clara y permitir
 * que otras capas (Application o Presentation) decidan
 * cómo manejarlo.
 */
final class UserAlreadyExistsException extends RuntimeException
{
    /**
     * Inicializa la excepción con el nombre de usuario duplicado.
     *
     * @param string $userName Nombre de usuario que ya existe.
     */
    public function __construct(string $userName)
    {
        parent::__construct("User with username '{$userName}' already exists.");
    }
}
