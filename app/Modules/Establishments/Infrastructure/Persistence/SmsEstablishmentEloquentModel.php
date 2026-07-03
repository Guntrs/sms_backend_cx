<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Eloquent que representa la tabla sms_establishment.
 *
 * Su responsabilidad es gestionar la persistencia de los datos
 * del establecimiento y definir las relaciones con otras tablas.
 */
class SmsEstablishmentEloquentModel extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'sms_establishment';

    /**
     * Llave primaria de la tabla.
     */
    protected $primaryKey = 'establishment_id';

    /**
     * La tabla no utiliza los timestamps automáticos
     * de Laravel (created_at y updated_at).
     */
    public $timestamps = false;

    /**
     * Campos que pueden asignarse de forma masiva.
     */
    protected $fillable = [
        'establishment_key',
        'parent_establishment_id',
        'establishment_name',
        'establishment_nit',
        'establishment_description',
        'establishment_address',
        'establishment_email',
        'establishment_phone',
        'establishment_type',
        'status',
        'created_by',
        'creation_date',
        'modified_by',
        'modification_date',
    ];

    /**
     * Relación con el catálogo de tipos de establecimiento.
     *
     * Permite obtener la información descriptiva del tipo
     * (por ejemplo, Tecnología, Comercio, Salud, etc.)
     * a partir del typology_id almacenado.
     */
    public function establishmentTypeTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'establishment_type',
            'typology_id'
        );
    }

    /**
     * Relación con el catálogo de estados.
     *
     * Permite obtener la descripción del estado
     * (por ejemplo, Activo, Inactivo o Suspendido)
     * utilizando el typology_id correspondiente.
     */
    public function statusTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'status',
            'typology_id'
        );
    }
}
