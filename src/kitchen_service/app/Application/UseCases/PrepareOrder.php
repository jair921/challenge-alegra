<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\OrderRepositoryInterface;
use App\Models\Order;

class PrepareOrder
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(Order $order)
    {
        // Marcar la orden como preparada
        $order->status = 'prepared';
        $this->orderRepository->updateOrder($order);

        return $order;
    }
}
