<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Persistence;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class SmsUserEloquentModel extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;

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

    public function person(): BelongsTo
    {
        return $this->belongsTo(
            SmsPersonEloquentModel::class,
            'person_id',
            'person_id'
        );
    }

    public function parentUser(): BelongsTo
    {
        return $this->belongsTo(
            SmsUserEloquentModel::class,
            'parent_user_id',
            'user_id'
        );
    }

    public function childUsers(): HasMany
    {
        return $this->hasMany(
            SmsUserEloquentModel::class,
            'parent_user_id',
            'user_id'
        );
    }

    public function establishments(): HasMany
    {
        return $this->hasMany(
            \App\Modules\Establishments\Infrastructure\Persistence\SmsUserEstablishmentEloquentModel::class,
            'users_id',
            'user_id'
        );
    }

    public function statusTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'status',
            'typology_id'
        );
    }
}
