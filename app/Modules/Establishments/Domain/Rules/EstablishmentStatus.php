<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Rules;

/**
 * Define los estados de negocio permitidos para un establecimiento.
 *
 * Estos valores corresponden a los registros de la tabla
 * sms_typologies dentro del catálogo de estados (parent = 500).
 *
 * Centralizar estos identificadores evita el uso de números
 * "mágicos" repartidos por la aplicación y facilita su mantenimiento.
 */
final class EstablishmentStatus
{
    /**
     * Estado: Activo.
     */
    public const ACTIVO = 501;

    /**
     * Estado: Inactivo.
     */
    public const INACTIVO = 502;

    /**
     * Estado: Suspendido.
     */
    public const SUSPENDIDO = 503;

    /**
     * Devuelve todos los estados válidos del dominio.
     *
     * Se utiliza para validar que un estado recibido
     * pertenece al conjunto permitido por las reglas
     * de negocio.
     *
     * @return int[] Lista de identificadores de estados válidos.
     */
    public static function values(): array
    {
        return [
            self::ACTIVO,
            self::INACTIVO,
            self::SUSPENDIDO,
        ];
    }
}
