<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Purchase;

interface PurchaseRepositoryInterface
{
    public function create(Purchase $purchase): Purchase;

    public function findById(int $id): ?Purchase;

    public function findPendingPurchases();

    public function updatePurchaseStatus(int $id, string $status): void;

    public function updatePurchaseQuantity(int $id, int $quantity): void;
}
