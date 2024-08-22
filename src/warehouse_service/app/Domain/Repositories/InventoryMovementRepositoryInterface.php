<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\InventoryMovement;

interface InventoryMovementRepositoryInterface
{
    public function recordMovement(InventoryMovement $movement): void;
    public function getMovementsByIngredient(string $name): array;
}
