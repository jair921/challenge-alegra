<?php

namespace App\Infrastructure\Http\Clients;

use Illuminate\Support\Facades\Http;

class InventoryClient
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.warehouse.endpoint');
    }

    public function getIngredientsAvailable()
    {
        $response = Http::get("{$this->baseUrl}/api/v1/ingredients");

        return $response->json();
    }

    public function updateInventory(array $ingredients): void
    {
        $response = Http::post("{$this->baseUrl}/api/v1/ingredients/order", [
            'ingredients' => $this->buildIngredients($ingredients),
        ]);
    }

    private function buildIngredients($ingredients)
    {
        $newIngredients = [];

        foreach ($ingredients as $name => $quantity)
        {
            $newIngredients[] = [
                'name' => $name,
                'quantity' => $quantity,
            ];
        }

        return $newIngredients;
    }
}
