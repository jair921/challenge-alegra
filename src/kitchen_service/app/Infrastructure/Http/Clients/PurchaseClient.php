<?php

namespace App\Infrastructure\Http\Clients;

use Illuminate\Support\Facades\Http;

class PurchaseClient
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.purchase.endpoint');
    }

    public function orderIngredients(string $ingredientName, int $quantity)
    {
        Http::post("{$this->baseUrl}/api/v1/purchases", [
            'ingredient_name' => $ingredientName,
            'quantity' => $quantity,
        ]);
    }
}
