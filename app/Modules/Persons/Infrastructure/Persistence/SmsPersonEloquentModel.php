<?php

declare(strict_types=1);

namespace App\Modules\Persons\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Typologies\Infrastructure\Persistence\SmsTypologyEloquentModel;

final class SmsPersonEloquentModel extends Model
{
    protected $table = 'sms_persons';

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
        'secondary_phone_number',
        'address',
        'status',
        'created_by',
        'creation_date',
        'modified_by',
        'modification_date',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'gender' => 'integer',
        'blood_type' => 'integer',
        'profession' => 'integer',
        'status' => 'integer',
        'creation_date' => 'datetime',
        'modification_date' => 'datetime',
    ];

    public function statusTypology()
    {
        return $this->belongsTo(SmsTypologyEloquentModel::class, 'status', 'typology_id');
    }

    public function genderTypology()
    {
        return $this->belongsTo(SmsTypologyEloquentModel::class, 'gender', 'typology_id');
    }

    public function bloodTypeTypology()
    {
        return $this->belongsTo(SmsTypologyEloquentModel::class, 'blood_type', 'typology_id');
    }

    public function professionTypology()
    {
        return $this->belongsTo(SmsTypologyEloquentModel::class, 'profession', 'typology_id');
    }
}
