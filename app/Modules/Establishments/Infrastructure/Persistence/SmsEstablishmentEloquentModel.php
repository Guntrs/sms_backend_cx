<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece el modelo.
namespace App\Modules\Establishments\Infrastructure\Persistence;

// Importa el modelo base de Eloquent.
use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| SmsEstablishmentEloquentModel
|--------------------------------------------------------------------------
| Modelo Eloquent que representa la tabla sms_establishment
| y permite interactuar con la base de datos.
*/
class SmsEstablishmentEloquentModel extends Model
{
    // Define la tabla asociada al modelo.
    protected $table = 'sms_establishment';

    // Define la clave primaria de la tabla.
    protected $primaryKey = 'establishment_id';

    // Desactiva el manejo automático de created_at y updated_at.
    public $timestamps = false;

    // Define los campos que pueden asignarse masivamente.
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
}
