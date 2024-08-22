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

    public function addIngredients(array $ingredients): void
    {
        Http::post("{$this->baseUrl}/api/v1/ingredients/add", $ingredients);
    }
}
