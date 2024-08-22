<?php

namespace App\Application\DTO;

class OrderData
{
    public int $userId;
    public int $recipeId;

    public function __construct(int $userId, int $recipeId)
    {
        $this->userId = $userId;
        $this->recipeId = $recipeId;
    }
}
