<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Infrastructure\Repositories;

use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;
use App\Modules\Establishments\Domain\Entities\Establishment;
use App\Modules\Establishments\Infrastructure\Persistence\SmsEstablishmentEloquentModel;
use Illuminate\Support\Str;

/**
 * Implementación del repositorio utilizando Eloquent.
 *
 * Su responsabilidad es traducir las operaciones del dominio
 * a consultas sobre la base de datos y convertir los modelos
 * Eloquent en entidades del dominio.
 */
final class EstablishmentEloquentRepository implements EstablishmentRepositoryInterface
{
    /**
     * Relaciones que siempre se cargan para evitar
     * consultas adicionales (N+1).
     */
    private const WITH_RELATIONS = [
        'establishmentTypeTypology',
        'statusTypology',
    ];

    /**
     * Busca un establecimiento por su identificador.
     */
    public function findById(int $id): ?Establishment
    {
        $model = SmsEstablishmentEloquentModel::with(self::WITH_RELATIONS)->find($id);

        return $model ? $this->toDomain($model) : null;
    }

    /**
     * Busca un establecimiento por su nombre.
     */
    public function findByName(string $name): ?Establishment
    {
        $model = SmsEstablishmentEloquentModel::with(self::WITH_RELATIONS)
            ->where('establishment_name', $name)
            ->first();

        return $model ? $this->toDomain($model) : null;
    }

    /**
     * Busca un establecimiento por su NIT.
     */
    public function findByNit(string $nit): ?Establishment
    {
        $model = SmsEstablishmentEloquentModel::with(self::WITH_RELATIONS)
            ->where('establishment_nit', $nit)
            ->first();

        return $model ? $this->toDomain($model) : null;
    }

    /**
     * Crea un nuevo establecimiento.
     *
     * Genera automáticamente la clave única y la fecha
     * de creación antes de guardar el registro.
     */
    public function create(array $data): Establishment
    {
        // Genera una clave única para el establecimiento.
        $data['establishment_key'] = (string) Str::uuid();

        // Registra la fecha de creación.
        $data['creation_date'] = now()->toDateTimeString();

        // Guarda el registro.
        $model = SmsEstablishmentEloquentModel::create($data);

        // Carga las relaciones necesarias.
        $model->load(self::WITH_RELATIONS);

        return $this->toDomain($model);
    }

    /**
     * Actualiza un establecimiento existente.
     */
    public function update(int $id, array $data): Establishment
    {
        // Registra la fecha de modificación.
        $data['modification_date'] = now()->toDateTimeString();

        // Obtiene el registro o lanza una excepción si no existe.
        $model = SmsEstablishmentEloquentModel::findOrFail($id);

        // Actualiza los datos.
        $model->update($data);

        // Devuelve la entidad con la información actualizada.
        return $this->toDomain($model->fresh(self::WITH_RELATIONS));
    }

    /**
     * Elimina un establecimiento por su identificador.
     */
    public function delete(int $id): bool
    {
        return (bool) SmsEstablishmentEloquentModel::where('establishment_id', $id)->delete();
    }

    /**
     * Obtiene una lista paginada de establecimientos.
     *
     * Cada modelo Eloquent se transforma en una entidad
     * del dominio antes de ser devuelto.
     */
    public function paginate(int $perPage = 15): mixed
    {
        return SmsEstablishmentEloquentModel::with(self::WITH_RELATIONS)
            ->orderBy('establishment_id')
            ->paginate($perPage)
            ->through(fn ($model) => $this->toDomain($model));
    }

    /**
     * Obtiene todos los establecimientos ordenados
     * por nombre.
     */
    public function all(): mixed
    {
        return SmsEstablishmentEloquentModel::with(self::WITH_RELATIONS)
            ->orderBy('establishment_name')
            ->get();
    }

    /**
     * Convierte un modelo Eloquent en una entidad
     * del dominio.
     *
     * Este mapeo evita que las capas superiores
     * dependan directamente de Eloquent.
     */
    private function toDomain(SmsEstablishmentEloquentModel $model): Establishment
    {
        return new Establishment(
            establishmentId:          $model->establishment_id,
            establishmentKey:         $model->establishment_key,
            parentEstablishmentId:    $model->parent_establishment_id,
            establishmentName:        $model->establishment_name,
            establishmentNit:         $model->establishment_nit,
            establishmentDescription: $model->establishment_description,
            establishmentAddress:     $model->establishment_address,
            establishmentEmail:       $model->establishment_email,
            establishmentPhone:       $model->establishment_phone,
            establishmentType:        (int) $model->establishment_type,
            status:                   (int) $model->status,
            createdBy:                $model->created_by,
            creationDate:             $model->creation_date,
            modifiedBy:               $model->modified_by,
            modificationDate:         $model->modification_date,

            // Nombre descriptivo del tipo de establecimiento.
            establishmentTypeName:    $model->establishmentTypeTypology?->description,

            // Nombre descriptivo del estado.
            statusName:               $model->statusTypology?->description,
        );
    }
}
