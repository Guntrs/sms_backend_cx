<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Exceptions;

use Exception;

// Se lanza cuando el usuario o contraseña son incorrectos
class InvalidCredentialsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Credenciales inválidas.');
    }
}
