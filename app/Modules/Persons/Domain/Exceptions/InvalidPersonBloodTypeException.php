<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Exceptions;

use Exception;

final class InvalidPersonBloodTypeException extends Exception
{
    public function __construct(int $bloodType)
    {
        parent::__construct("Invalid person blood type: {$bloodType}.");
    }
}
