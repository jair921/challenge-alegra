<?php

namespace App\Domain\Entities;

class Ingredient
{
    private string $name;
    private int $quantity;

    public function __construct(string $name, int $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function decreaseQuantity(int $amount): void
    {
        if ($amount > $this->quantity) {
            throw new \InvalidArgumentException('Insufficient quantity');
        }
        $this->quantity -= $amount;
    }

    public function increaseQuantity(int $amount): void
    {
        $this->quantity += $amount;
    }
}
