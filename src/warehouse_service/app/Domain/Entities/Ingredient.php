<?php

namespace App\Domain\Entities;

class Ingredient
{
    private int $id;
    private string $name;
    private int $quantity;

    public function __construct(int $id, string $name, int $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity
        ];
    }
}

