<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\InventoryMovement;
use App\Domain\Repositories\InventoryMovementRepositoryInterface;
use App\Models\InventoryMovement as InventoryMovementModel;

class EloquentInventoryMovementRepository implements InventoryMovementRepositoryInterface
{
    public function recordMovement(InventoryMovement $movement): void
    {
        InventoryMovementModel::create([
            'ingredient_id' => $movement->getIngredientId(),
            'quantity' => $movement->getQuantity(),
            'movement_type' => $movement->getMovementType(),
        ]);
    }

    public function getMovementsByIngredient(string $name): array
    {
        return InventoryMovementModel::where('ingredient_name', $name)
            ->orderBy('desc')
            ->get()
            ->map(function ($model) {
                return new InventoryMovement(
                    $model->name,
                    $model->quantity,
                    $model->movement_type
                );
            })
            ->toArray();
    }
}
