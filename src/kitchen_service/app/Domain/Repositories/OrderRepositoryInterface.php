<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Order;

interface OrderRepositoryInterface
{
    public function create($recipeId): \App\Models\Order;
    public function findById(int $id): ?Order;
    public function updateOrder($order);
    public function getPendingOrders(): array;
}
