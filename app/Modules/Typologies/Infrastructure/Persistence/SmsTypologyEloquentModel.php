<?php

declare(strict_types=1);

namespace App\Modules\Typologies\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsTypologyEloquentModel extends Model
{
    protected $table      = 'sms_typologies';
    protected $primaryKey = 'typology_id';

    public $timestamps = false;

    protected $fillable = [
        'parent_typology_id',
        'description',
        'value1',
        'value2',
        'value3',
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

    public function children(): HasMany
    {
        return $this->hasMany(
            SmsTypologyEloquentModel::class,
            'parent_typology_id',
            'typology_id'
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            SmsTypologyEloquentModel::class,
            'parent_typology_id',
            'typology_id'
        );
    }
}
