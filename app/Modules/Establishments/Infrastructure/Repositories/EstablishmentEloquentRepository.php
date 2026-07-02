<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece el repositorio.
namespace App\Modules\Establishments\Infrastructure\Repositories;

// Importa el contrato que implementará este repositorio.
use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;

// Importa la entidad del dominio.
use App\Modules\Establishments\Domain\Entities\Establishment;

// Importa el modelo Eloquent para acceder a la base de datos.
use App\Modules\Establishments\Infrastructure\Persistence\SmsEstablishmentEloquentModel;

// Importa la utilidad para generar UUID.
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| EstablishmentEloquentRepository
|--------------------------------------------------------------------------
| Implementa el contrato del repositorio utilizando Eloquent
| para acceder a la base de datos.
*/
final class EstablishmentEloquentRepository implements EstablishmentRepositoryInterface
{
    // Busca un establecimiento por su ID.
    public function findById(int $id): ?Establishment
    {
        $model = SmsEstablishmentEloquentModel::find($id);

        // Convierte el modelo Eloquent en una entidad del dominio.
        return $model ? $this->toDomain($model) : null;
    }

    // Busca un establecimiento por su nombre.
    public function findByName(string $name): ?Establishment
    {
        $model = SmsEstablishmentEloquentModel::where('establishment_name', $name)->first();

        // Convierte el modelo Eloquent en una entidad del dominio.
        return $model ? $this->toDomain($model) : null;
    }

    // Busca un establecimiento por su NIT.
    public function findByNit(string $nit): ?Establishment
    {
        $model = SmsEstablishmentEloquentModel::where('establishment_nit', $nit)->first();

        // Convierte el modelo Eloquent en una entidad del dominio.
        return $model ? $this->toDomain($model) : null;
    }

    // Crea un nuevo establecimiento.
    public function create(array $data): Establishment
    {
        // Genera un UUID único para el establecimiento.
        $data['establishment_key'] = (string) Str::uuid();

        // Asigna la fecha de creación.
        $data['creation_date'] = now()->toDateTimeString();

        // Guarda el registro en la base de datos.
        $model = SmsEstablishmentEloquentModel::create($data);

        // Convierte el modelo Eloquent en una entidad del dominio.
        return $this->toDomain($model);
    }

    // Actualiza un establecimiento existente.
    public function update(int $id, array $data): Establishment
    {
        // Asigna la fecha de modificación.
        $data['modification_date'] = now()->toDateTimeString();

        // Obtiene el modelo o lanza una excepción si no existe.
        $model = SmsEstablishmentEloquentModel::findOrFail($id);

        // Actualiza el registro.
        $model->update($data);

        // Devuelve la entidad actualizada.
        return $this->toDomain($model->fresh());
    }

    // Elimina un establecimiento por su ID.
    public function delete(int $id): bool
    {
        return (bool) SmsEstablishmentEloquentModel::where('establishment_id', $id)->delete();
    }

    // Devuelve una lista paginada de establecimientos.
    public function paginate(int $perPage = 15): mixed
        {
            $paginator = SmsEstablishmentEloquentModel::orderBy('establishment_id')
                ->paginate($perPage);

            $paginator->through(fn($model) => $this->toDomain($model));

            return $paginator;
        }

    // Devuelve todos los establecimientos ordenados por nombre.
    public function all(): mixed
    {
        return SmsEstablishmentEloquentModel::orderBy('establishment_name')->get();
    }

    // Convierte un modelo Eloquent en una entidad del dominio.
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
            establishmentType:        $model->establishment_type,
            status:                   $model->status,
            createdBy:                $model->created_by,
            creationDate:             $model->creation_date,
            modifiedBy:               $model->modified_by,
            modificationDate:         $model->modification_date,
        );
    }
}
