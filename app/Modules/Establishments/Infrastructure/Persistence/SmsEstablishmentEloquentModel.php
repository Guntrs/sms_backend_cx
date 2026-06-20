<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsEstablishmentEloquentModel extends Model
{
    protected $table      = 'sms_establishment';
    protected $primaryKey = 'establishment_id';

    public $timestamps = false;

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

    protected $casts = [
        'creation_date'     => 'datetime',
        'modification_date' => 'datetime',
        'status'            => 'integer',
    ];

    // Un establecimiento puede tener sub-establecimientos
    public function children(): HasMany
    {
        return $this->hasMany(
            SmsEstablishmentEloquentModel::class,
            'parent_establishment_id',
            'establishment_id'
        );
    }

    // Un establecimiento puede tener un padre
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            SmsEstablishmentEloquentModel::class,
            'parent_establishment_id',
            'establishment_id'
        );
    }

    // Un establecimiento tiene muchos usuarios asignados
    public function usersEstablishment(): HasMany
    {
        return $this->hasMany(
            SmsUserEstablishmentEloquentModel::class,
            'establishment_id',
            'establishment_id'
        );
    }
}
