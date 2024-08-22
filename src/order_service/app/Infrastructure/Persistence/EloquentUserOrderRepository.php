<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\UserOrder;
use App\Domain\Repositories\UserOrderRepositoryInterface;
use App\Models\UserOrder as UserOrderModel;

class EloquentUserOrderRepository implements UserOrderRepositoryInterface
{
    public function createUserOrder(int $userId, int $orderId): UserOrder
    {
        $userOrder = UserOrderModel::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'status' => 'pending',
        ]);

        return new UserOrder(
            $userOrder->id,
            $userOrder->user_id,
            $userOrder->order_id,
            $userOrder->status,
            $userOrder->created_at,
            $userOrder->updated_at
        );
    }

    public function paginateUserOrders(int $userId, int $perPage = 10)
    {
        return UserOrderModel::query()->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $orderId)
    {
        return UserOrderModel::query()->find($orderId);
    }

    public function updateOrderStatus(int $orderId, string $status){
        $order = UserOrderModel::query()->find($orderId);
        $order->status = $status;
        $order->save();
    }
}
