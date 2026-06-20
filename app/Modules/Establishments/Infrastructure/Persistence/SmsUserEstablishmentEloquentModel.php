<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsUserEstablishmentEloquentModel extends Model
{
    protected $table      = 'sms_users_establishment';
    protected $primaryKey = 'users_establishment_id';

    public $timestamps = false;

    protected $fillable = [
        'users_id',
        'establishment_id',
        'role',
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
        'role'              => 'integer',
    ];

    // Pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel::class,
            'users_id',
            'user_id'
        );
    }

    // Pertenece a un establecimiento
    public function establishment(): BelongsTo
    {
        return $this->belongsTo(
            SmsEstablishmentEloquentModel::class,
            'establishment_id',
            'establishment_id'
        );
    }

    // El rol referencia a sms_typologies
    public function rolTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'role',
            'typology_id'
        );
    }
}
