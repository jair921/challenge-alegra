<?php

namespace App\Http\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GatewayClient
{
    protected $baseUrl;
    protected $token;
    protected $userId;

    public function __construct()
    {
        $this->baseUrl = config('services.gateway.endpoint');
        $this->token = config('services.gateway.token');
        $this->userId = config('services.gateway.user');
    }

    /**
     * @throws ConnectionException
     */
    public function fetchOrders($page)
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/orders", ['page' => $page]);
        return $response->json();
    }

    public function createOrders()
    {
        $response = Http::withToken($this->token)
            ->post("{$this->baseUrl}/api/v1/orders", [
                'user_id' => $this->userId,
            ]);

        return $response->json();
    }

    public function fetchRandomRecipe()
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/kitchen/ramdom");

        return $response->json();
    }

    public function fetchRecipe($recipe)
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/kitchen/recipes/{$recipe}");

        return $response->json();
    }

    public function fetchIngredients()
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/warehouse/ingredients");

        return $response->json();
    }

    public function fetchPurchases($page)
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/purchases", ['page' => $page]);

        return $response->json();
    }

    public function fetchRecipes()
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/kitchen/recipes");

        return $response->json();
    }

    public function fetchOrderKitchen($order)
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/api/v1/kitchen/orders/{$order}");
        return $response->json();
    }
}
