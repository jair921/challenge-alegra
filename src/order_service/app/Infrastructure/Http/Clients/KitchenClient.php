<?php

namespace App\Infrastructure\Http\Clients;

use Illuminate\Support\Facades\Http;

class KitchenClient
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.kitchen.endpoint');
    }

    public function getRandomRecipe(): array
    {
        $response = Http::get("{$this->baseUrl}/api/v1/recipes/random");

        return $response->json();
    }

    public function createOrder(int $recipeId): array
    {
        $response = Http::post("{$this->baseUrl}/api/v1/orders", [
            'recipe_id' => $recipeId,
        ]);

        return $response->json();
    }
}
