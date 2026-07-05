<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Rules;

final class PersonGender
{
    public const MASCULINO = 291;
    public const FEMENINO = 292;

    public static function values(): array
    {
        return [self::MASCULINO, self::FEMENINO];
    }
}
