<?php
/**
 * Habilita el tipado estricto para evitar conversiones implícitas de tipos
 * y garantizar un comportamiento más predecible en toda la clase.
 */
declare(strict_types=1);
/**
 * Define el espacio de nombres de la entidad dentro del módulo Establishments.
 */

namespace App\Modules\Establishments\Domain\Entities;

/**
 * Entidad de dominio que representa un establecimiento dentro del sistema.
 *
 * Responsabilidades:
 * - Modelar la información de un establecimiento.
 * - Actuar como un objeto inmutable del dominio.
 * - No contener lógica relacionada con persistencia, HTTP o infraestructura.
 *
 * Esta entidad es utilizada para transportar información entre las capas
 * de Dominio, Aplicación e Infraestructura respetando los principios de
 * Clean Architecture.
 */
final class Establishment
{
    /**
     * Crea una nueva instancia inmutable de un establecimiento.
     *
     * @param int         $establishmentId        Identificador único del establecimiento.
     * @param string      $establishmentKey       Clave única del establecimiento.
     * @param int|null    $parentEstablishmentId  Identificador del establecimiento padre, si existe.
     * @param string      $establishmentName      Nombre del establecimiento.
     * @param string|null $establishmentNit       NIT del establecimiento.
     * @param string|null $establishmentDescription Descripción del establecimiento.
     * @param string|null $establishmentAddress   Dirección física.
     * @param string|null $establishmentEmail     Correo electrónico de contacto.
     * @param string|null $establishmentPhone     Número telefónico de contacto.
     * @param string|null $establishmentType      Tipo o categoría del establecimiento.
     * @param int         $status                 Estado actual del registro.
     * @param int|null    $createdBy              Identificador del usuario que creó el registro.
     * @param string|null $creationDate           Fecha y hora de creación.
     * @param int|null    $modifiedBy             Identificador del usuario que realizó la última modificación.
     * @param string|null $modificationDate       Fecha y hora de la última modificación.
     */
    public function __construct(
        public readonly int     $establishmentId,
        public readonly string  $establishmentKey,
        public readonly ?int    $parentEstablishmentId,
        public readonly string  $establishmentName,
        public readonly ?string $establishmentNit,
        public readonly ?string $establishmentDescription,
        public readonly ?string $establishmentAddress,
        public readonly ?string $establishmentEmail,
        public readonly ?string $establishmentPhone,
        public readonly ?string $establishmentType,
        public readonly int     $status,
        public readonly ?int    $createdBy,
        public readonly ?string $creationDate,
        public readonly ?int    $modifiedBy,
        public readonly ?string $modificationDate,
    ) {}
}
