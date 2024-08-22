<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserOrder;

interface UserOrderRepositoryInterface
{
    public function createUserOrder(int $userId, int $orderId): UserOrder;

    public function paginateUserOrders(int $userId, int $perPage = 10);
}
