<?php

namespace App\Domain\Entities;

class InventoryMovement
{
    private int $ingredientId;
    private int $quantity;
    private string $movementType;
    private \DateTime $timestamp;

    public function __construct(int $ingredientId, int $quantity, string $movementType)
    {
        $this->ingredientId = $ingredientId;
        $this->quantity = $quantity;
        $this->movementType = $movementType;
    }

    public function getIngredientId(): int
    {
        return $this->ingredientId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getMovementType(): string
    {
        return $this->movementType;
    }
}
