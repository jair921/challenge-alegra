<?php

namespace App\Domain\Entities;

class UserOrder
{
    private int $userId;
    private int $orderId;
    private string $status;

    public function __construct(int $userId, int $orderId, string $status)
    {
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->status = $status;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
