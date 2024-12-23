<?php

namespace App\Infrastructure\Http\Clients;

use Illuminate\Support\Facades\Http;

class OrdersClient
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.orders.endpoint'); // Configura el endpoint en config/services.php
    }

    public function completeOrder(int $orderId)
    {
        $response = Http::post("{$this->baseUrl}/api/v1/orders/{$orderId}/complete");

        return $response->json();
    }
}
