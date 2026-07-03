<?php

declare(strict_types=1);

namespace App\Modules\Users\Domain\Rules;

/**
 * Estados válidos del usuario.
 *
 * Corresponden a los typology_id definidos en sms_typologies
 * bajo el catálogo de estados (parent 500).
 *
 * Esta clase centraliza la regla de negocio: cuáles son los
 * únicos valores permitidos para el status de un usuario.
 */
final class UserStatus
{
    public const ACTIVO = 501;
    public const INACTIVO = 502;
    public const SUSPENDIDO = 503;

    /**
     * Devuelve todos los valores permitidos.
     *
     * @return int[]
     */
    public static function values(): array
    {
        return [self::ACTIVO, self::INACTIVO, self::SUSPENDIDO];
    }
}
