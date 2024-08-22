<?php

namespace App\Domain\Entities;

class Purchase
{
    private string $ingredientName;
    private int $quantity;
    private \DateTime $purchaseDate;
    private string $status;

    public function __construct(string $ingredientName, int $quantity, \DateTime $purchaseDate, string $status)
    {
        $this->ingredientName = $ingredientName;
        $this->quantity = $quantity;
        $this->purchaseDate = $purchaseDate;
        $this->status = $status;
    }

    public function getIngredientName(): string
    {
        return $this->ingredientName;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPurchaseDate(): \DateTime
    {
        return $this->purchaseDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function toArray(): array
    {
        return [
            'ingredient_name' => $this->ingredientName,
            'quantity' => $this->quantity,
            'purchase_date' => $this->purchaseDate->format('Y-m-d H:i:s'),
            'status' => $this->status,
        ];
    }
}
