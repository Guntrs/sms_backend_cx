<?php

declare(strict_types=1);

namespace App\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    public function __construct(
        protected readonly Model $model
    ) {}

    // Busca un registro por su PK
    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    // Retorna todos los registros activos paginados
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('status', 1)
            ->orderByDesc($this->model->getKeyName())
            ->paginate($perPage);
    }

    // Crea un nuevo registro
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    // Actualiza un registro por su PK
    public function update(int $id, array $data): ?Model
    {
        $record = $this->findById($id);

        if (!$record) {
            return null;
        }

        $record->update($data);
        return $record->fresh();
    }

    // Soft delete lógico — cambia status a 0
    public function delete(int $id): bool
    {
        $record = $this->findById($id);

        if (!$record) {
            return false;
        }

        return $record->update(['status' => 0]);
    }
}
