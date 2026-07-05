<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Exceptions;

use Exception;

final class PersonAlreadyExistsException extends Exception
{
    public function __construct(string $dpi)
    {
        parent::__construct("Person with dpi {$dpi} already exists.");
    }
}
