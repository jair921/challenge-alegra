<?php

namespace App\Domain\Entities;

class Order
{
    private int $id;
    private int $recipeId;
    private string $status;

    public function __construct(int $id, int $recipeId, string $status)
    {
        $this->id = $id;
        $this->recipeId = $recipeId;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecipeId(): int
    {
        return $this->recipeId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
