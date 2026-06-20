<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SmsPersonEloquentModel extends Model
{
    protected $table      = 'sms_persons';
    protected $primaryKey = 'person_id';

    public $timestamps = false;

    protected $fillable = [
        'person_key',
        'first_name',
        'second_name',
        'first_surname',
        'second_surname',
        'birthdate',
        'gender',
        'blood_type',
        'profession',
        'dpi',
        'nit',
        'email',
        'phone_number',
        'secondary_phone_numer',
        'address',
        'status',
        'created_by',
        'creation_date',
        'modified_by',
        'modification_date',
    ];

    protected $casts = [
        'birthdate'         => 'date',
        'creation_date'     => 'datetime',
        'modification_date' => 'datetime',
        'status'            => 'integer',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(
            SmsUserEloquentModel::class,
            'person_id',
            'person_id'
        );
    }

    public function customer(): HasOne
    {
        return $this->hasOne(
            \App\Modules\Customers\Infrastructure\Persistence\SmsCustomerEloquentModel::class,
            'person_id',
            'person_id'
        );
    }

    public function provider(): HasOne
    {
        return $this->hasOne(
            \App\Modules\Providers\Infrastructure\Persistence\SmsProviderEloquentModel::class,
            'person_id',
            'person_id'
        );
    }
}
