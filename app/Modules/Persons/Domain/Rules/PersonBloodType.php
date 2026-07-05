<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Rules;

final class PersonBloodType
{
    public const O_POSITIVO = 301;
    public const O_NEGATIVO = 302;
    public const A_POSITIVO = 303;
    public const B_POSITIVO = 304;

    public static function values(): array
    {
        return [self::O_POSITIVO, self::O_NEGATIVO, self::A_POSITIVO, self::B_POSITIVO];
    }
}
