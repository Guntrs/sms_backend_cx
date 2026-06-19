<?php

declare(strict_types=1);

namespace App\Core;

// Contrato base que todo UseCase del sistema debe implementar.
// Cada UseCase tiene UNA sola responsabilidad: ejecutar una acción.
abstract class BaseUseCase
{
    // Todo UseCase expone únicamente este método.
    // Recibe un DTO y retorna el resultado de la operación.
    abstract public function execute(mixed $dto = null): mixed;
}
