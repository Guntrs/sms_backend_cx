<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Persistence;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Extiende Authenticatable (no Model) porque este modelo
// será usado por Laravel Sanctum en Fase 2 para autenticación
class SmsUserEloquentModel extends Authenticatable
{
    protected $table      = 'sms_users';
    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $fillable = [
        'user_key',
        'parent_user_id',
        'person_id',
        'user_name',
        'password',
        'password_change_date',
        'access_attempt',
        'user_full_name',
        'user_email',
        'user_phone',
        'professional_number',
        'signature',
        'image_url',
        'status',
        'created_by',
        'creation_date',
        'modified_by',
        'modification_date',
    ];

    // Campos que nunca se exponen en respuestas JSON
    protected $hidden = [
        'password',
        'signature',
    ];

    protected $casts = [
        'password_change_date' => 'datetime',
        'creation_date'        => 'datetime',
        'modification_date'    => 'datetime',
        'status'               => 'integer',
        'access_attempt'       => 'integer',
    ];

    // Un usuario pertenece a una persona
    public function person(): BelongsTo
    {
        return $this->belongsTo(
            SmsPersonEloquentModel::class,
            'person_id',
            'person_id'
        );
    }

    // Un usuario puede tener un usuario padre
    public function parentUser(): BelongsTo
    {
        return $this->belongsTo(
            SmsUserEloquentModel::class,
            'parent_user_id',
            'user_id'
        );
    }

    // Un usuario puede tener sub-usuarios
    public function childUsers(): HasMany
    {
        return $this->hasMany(
            SmsUserEloquentModel::class,
            'parent_user_id',
            'user_id'
        );
    }

    // Un usuario puede estar asignado a varios establecimientos
    public function establishments(): HasMany
    {
        return $this->hasMany(
            \App\Modules\Establishments\Infrastructure\Persistence\SmsUserEstablishmentEloquentModel::class,
            'users_id',
            'user_id'
        );
    }
}
