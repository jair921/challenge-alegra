<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserOrderRepositoryInterface;

class CompleteOrder
{
    private $orderRepository;

    public function __construct(UserOrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(int $orderId): array
    {
        // Verificar si la orden existe
        $order = $this->orderRepository->findById($orderId);

        if (!$order) {
            return ['success' => false, 'message' => 'Order not found'];
        }

        // Actualizar el estado de la orden a 'completed'
        $this->orderRepository->updateOrderStatus($orderId, 'completed');

        return ['success' => true, 'message' => 'Order completed successfully'];
    }
}
