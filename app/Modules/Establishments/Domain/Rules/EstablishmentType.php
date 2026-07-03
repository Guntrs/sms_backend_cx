<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Rules;

/**
 * Define los tipos de establecimiento permitidos por el dominio.
 *
 * Estos valores corresponden a los registros de la tabla
 * sms_typologies dentro del catálogo de sectores (parent = 220).
 *
 * Centralizar estos identificadores evita el uso de números
 * "mágicos" en la aplicación y facilita su mantenimiento.
 */
final class EstablishmentType
{
    /**
     * Tipo de establecimiento: Tecnología.
     */
    public const TECNOLOGIA = 221;

    /**
     * Tipo de establecimiento: Comercio.
     */
    public const COMERCIO = 222;

    /**
     * Tipo de establecimiento: Servicios.
     */
    public const SERVICIOS = 223;

    /**
     * Tipo de establecimiento: Administración.
     */
    public const ADMINISTRACION = 224;

    /**
     * Tipo de establecimiento: Público.
     */
    public const PUBLICO = 225;

    /**
     * Tipo de establecimiento: Salud.
     */
    public const SALUD = 226;

    /**
     * Devuelve todos los tipos de establecimiento válidos.
     *
     * Se utiliza para validar que el tipo recibido
     * pertenece al conjunto permitido por las reglas
     * de negocio.
     *
     * @return int[] Lista de identificadores de tipos válidos.
     */
    public static function values(): array
    {
        return [
            self::TECNOLOGIA,
            self::COMERCIO,
            self::SERVICIOS,
            self::ADMINISTRACION,
            self::PUBLICO,
            self::SALUD,
        ];
    }
}
