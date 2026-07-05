<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Exceptions;

use Exception;

final class InvalidPersonProfessionException extends Exception
{
    public function __construct(int $profession)
    {
        parent::__construct("Invalid person profession: {$profession}.");
    }
}
