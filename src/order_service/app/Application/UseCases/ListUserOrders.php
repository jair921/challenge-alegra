<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserOrderRepositoryInterface;

class ListUserOrders
{
    private $userOrderRepository;

    public function __construct(UserOrderRepositoryInterface $userOrderRepository)
    {
        $this->userOrderRepository = $userOrderRepository;
    }

    public function execute(int $userId, int $perPage = 10)
    {
        return $this->userOrderRepository->paginateUserOrders($userId, $perPage);
    }
}
