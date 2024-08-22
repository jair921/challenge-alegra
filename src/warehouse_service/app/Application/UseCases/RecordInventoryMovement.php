<?php

namespace App\Application\UseCases;

use App\Domain\Entities\InventoryMovement;
use App\Domain\Repositories\InventoryMovementRepositoryInterface;
use App\Domain\Repositories\IngredientRepositoryInterface;

class RecordInventoryMovement
{
    private InventoryMovementRepositoryInterface $inventoryMovementRepository;
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(
        InventoryMovementRepositoryInterface $inventoryMovementRepository,
        IngredientRepositoryInterface $ingredientRepository
    ) {
        $this->inventoryMovementRepository = $inventoryMovementRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    public function execute(array $data, string $movement): void
    {
        foreach ($data['ingredients'] as $ingredientData) {
            $ingredient = $this->ingredientRepository->findByName($ingredientData['name']);
            if (!$ingredient) {
                throw new \Exception("Ingredient not found: " . $ingredientData['name']);
            }

            $movement = new InventoryMovement(
                $ingredient->getId(),
                $ingredientData['quantity'],
                $movement
            );

            $this->inventoryMovementRepository->recordMovement($movement);
        }
    }
}
