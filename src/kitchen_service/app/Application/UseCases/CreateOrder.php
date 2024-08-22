<?php

namespace App\Application\UseCases;

use App\Infrastructure\Http\Clients\InventoryClient;
use App\Infrastructure\Http\Clients\PurchaseClient;
use App\Domain\Repositories\OrderRepositoryInterface;
use App\Domain\Repositories\RecipeRepositoryInterface;

class CreateOrder
{
    private $orderRepository;
    private $recipeRepository;
    private $inventoryClient;
    private $purchaseClient;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        RecipeRepositoryInterface $recipeRepository,
        InventoryClient $inventoryClient,
        PurchaseClient $purchaseClient
    ) {
        $this->orderRepository = $orderRepository;
        $this->recipeRepository = $recipeRepository;
        $this->inventoryClient = $inventoryClient;
        $this->purchaseClient = $purchaseClient;
    }

    public function execute(int $recipeId)
    {
        // Obtener la receta
        $recipe = $this->recipeRepository->findById($recipeId);

        if (!$recipe) {
            return ['success' => false, 'message' => 'Recipe not found'];
        }

        // Verificar la disponibilidad de los ingredientes
        $ingredients = $recipe['ingredients'];

        $response = $this->inventoryClient->fetchIngredientsAvailable();

        foreach ($ingredients as $name => $quantityRequired) {
            $availableIngredient = collect($response)->firstWhere('name', $name);
            if (!$availableIngredient || $availableIngredient['quantity'] < $quantityRequired) {
                // Solicitar ingredientes al servicio de compras
                $this->purchaseClient->orderIngredients($name, $quantityRequired - ($availableIngredient['quantity'] ?? 0));
            }
        }

        // Crear la orden
        $order = $this->orderRepository->create($recipeId);

        if (!$order) {
            return ['success' => false, 'message' => 'Failed to create order'];
        }

        // Disminuir la cantidad de ingredientes en la bodega
        $this->inventoryClient->updateInventory($ingredients);

        return ['success' => true, 'order' => $order];
    }
}
