<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Rules;

final class PersonStatus
{
    public const ACTIVO = 501;
    public const INACTIVO = 502;
    public const SUSPENDIDO = 503;

    public static function values(): array
    {
        return [self::ACTIVO, self::INACTIVO, self::SUSPENDIDO];
    }
}
