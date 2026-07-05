<?php

declare(strict_types=1);

namespace App\Modules\Customers\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SmsCustomerEloquentModel extends Model
{
    protected $table      = 'sms_customers';
    protected $primaryKey = 'customer_id';

    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'customer_key',
        'customer_full_name',
        'customer_type',
        'customer_segment',
        'credit_limit',
        'currency',
        'status',
        'created_by',
        'creation_date',
        'modified_by',
        'modification_date',
    ];

    protected $casts = [
        'credit_limit'      => 'decimal:2',
        'creation_date'     => 'datetime',
        'modification_date' => 'datetime',
        'status'            => 'integer',
    ];

    // Un cliente pertenece a una persona
    public function person(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Persons\Infrastructure\Persistence\SmsPersonEloquentModel::class,
            'person_id',
            'person_id'
        );
    }

    // Tipo de cliente referencia a sms_typologies
    public function customerTypeTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'customer_type',
            'typology_id'
        );
    }

    // Segmento de cliente referencia a sms_typologies
    public function customerSegmentTypology(): BelongsTo
    {
        return $this->belongsTo(
            \App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel::class,
            'customer_segment',
            'typology_id'
        );
    }
}
