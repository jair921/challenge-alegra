<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Order;
use App\Domain\Repositories\OrderRepositoryInterface;
use App\Models\Order as OrderModel;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function create($recipeId): OrderModel
    {
        return OrderModel::create([
            'recipe_id' => $recipeId,
            'status' => 'in_progress'
        ]);
    }

    public function findById(int $id): ?Order
    {
        $model = OrderModel::find($id);
        return $model ? new Order($model->id, $model->recipe_id, $model->status) : null;
    }

    public function updateOrder($order)
    {
        $order->save();
    }

    public function getPendingOrders(): array
    {
        return OrderModel::query()->where('status', 'in_progress')->get()->toArray();
    }
}
