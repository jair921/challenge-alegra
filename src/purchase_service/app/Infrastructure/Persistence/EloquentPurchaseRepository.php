<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Purchase;
use App\Domain\Repositories\PurchaseRepositoryInterface;
use App\Models\Purchase as PurchaseModel;

class EloquentPurchaseRepository implements PurchaseRepositoryInterface
{
    public function create(Purchase $purchase): Purchase
    {
        $purchaseModel = PurchaseModel::create($purchase->toArray());
        return new Purchase(
            $purchaseModel->ingredient_name,
            $purchaseModel->quantity,
            new \DateTime($purchaseModel->purchase_date),
            $purchaseModel->status
        );
    }

    public function findById(int $id): ?Purchase
    {
        $purchaseModel = PurchaseModel::find($id);

        if (!$purchaseModel) {
            return null;
        }

        return new Purchase(
            $purchaseModel->ingredient_name,
            $purchaseModel->quantity,
            new \DateTime($purchaseModel->purchase_date),
            $purchaseModel->status
        );
    }

    public function findPendingPurchases()
    {
        return PurchaseModel::where('status', 'pending')
            ->orderBy('purchase_date')
            ->get();
    }

    public function updatePurchaseStatus(int $id, string $status): void
    {
        $purchase = PurchaseModel::find($id);
        if ($purchase) {
            $purchase->status = $status;
            $purchase->save();
        }
    }

    public function updatePurchaseQuantity(int $id, int $quantity): void
    {
        $purchase = PurchaseModel::query()->find($id);
        if ($purchase) {
            $purchase->quantity = $quantity;
            $purchase->save();
        }
    }

    public function paginatePurchases(int $perPage = 10)
    {
        return PurchaseModel::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
