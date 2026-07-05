<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Exceptions;

use Exception;

final class InvalidPersonGenderException extends Exception
{
    public function __construct(int $gender)
    {
        parent::__construct("Invalid person gender: {$gender}.");
    }
}
