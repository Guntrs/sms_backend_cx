<?php

declare(strict_types=1);

namespace App\Modules\Providers\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsProviderEloquentModel extends Model
{
    protected $table      = 'sms_providers';
    protected $primaryKey = 'provider_id';

    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'provider_key',
        'provider_full_name',
        'provider_type',
        'provider_segment',
        'currency',
        'payment_terms',
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

    // Un proveedor pertenece a una persona
    public function person(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Users\Infrastructure\Persistence\SmsPersonEloquentModel::class,
            'person_id',
            'person_id'
        );
    }

    // Tipo de proveedor referencia a sms_typologies
    public function providerTypeTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'provider_type',
            'typology_id'
        );
    }

    // Segmento de proveedor referencia a sms_typologies
    public function providerSegmentTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'provider_segment',
            'typology_id'
        );
    }

    // Términos de pago referencia a sms_typologies
    public function paymentTermsTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'payment_terms',
            'typology_id'
        );
    }
}
