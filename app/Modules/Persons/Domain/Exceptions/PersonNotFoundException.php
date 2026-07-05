<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Exceptions;

use Exception;

final class PersonNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Person with id {$id} not found.");
    }
}
