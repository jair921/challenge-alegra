<?php

namespace App\Application\UseCases;

use App\Infrastructure\Http\Clients\InventoryClient;
use App\Domain\Repositories\OrderRepositoryInterface;
use App\Domain\Repositories\RecipeRepositoryInterface;

class CreateOrder
{
    private $orderRepository;
    private $recipeRepository;
    private $inventoryClient;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        RecipeRepositoryInterface $recipeRepository,
        InventoryClient $inventoryClient
    ) {
        $this->orderRepository = $orderRepository;
        $this->recipeRepository = $recipeRepository;
        $this->inventoryClient = $inventoryClient;
    }

    public function execute(int $recipeId)
    {
        // Obtener la receta
        $recipe = $this->recipeRepository->findById($recipeId);

        if (!$recipe) {
            return ['success' => false, 'message' => 'Recipe not found'];
        }

        // Obtener los ingredientes de la receta
        $ingredients = $recipe['ingredients'];

        // Verificar la disponibilidad de los ingredientes
        $response = $this->inventoryClient->getIngredientsAvailable();

        // Verificar si todos los ingredientes están disponibles en la cantidad requerida
        foreach ($ingredients as $name => $quantityRequired) {

            $availableIngredient = collect($response)->firstWhere('name', $name);

            if (!$availableIngredient || $availableIngredient['quantity'] < $quantityRequired) {
                return ['success' => false, 'message' => "Insufficient quantity for ingredient: $name"];
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
