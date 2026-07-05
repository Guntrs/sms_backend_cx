<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Exceptions;

use Exception;

final class InvalidPersonStatusException extends Exception
{
    public function __construct(int $status)
    {
        parent::__construct("Invalid person status: {$status}.");
    }
}
