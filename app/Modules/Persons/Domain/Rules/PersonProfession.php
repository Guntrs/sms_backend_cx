<?php

declare(strict_types=1);

namespace App\Modules\Persons\Domain\Rules;

final class PersonProfession
{
    public const COMERCIANTE = 521;
    public const ESTUDIANTE = 522;
    public const GRADUADO = 523;
    public const EMPLEADO = 524;
    public const TECNICO = 525;
    public const ADMINISTRADOR = 526;
    public const EMPRESARIO = 527;
    public const DOCTOR = 528;

    public static function values(): array
    {
        return [
            self::COMERCIANTE,
            self::ESTUDIANTE,
            self::GRADUADO,
            self::EMPLEADO,
            self::TECNICO,
            self::ADMINISTRADOR,
            self::EMPRESARIO,
            self::DOCTOR,
        ];
    }
}
