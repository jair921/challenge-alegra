<?php

namespace App\Jobs;

use App\Domain\Repositories\OrderRepositoryInterface;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Infrastructure\Http\Clients\InventoryClient;
use App\Infrastructure\Http\Clients\OrdersClient;
use App\Infrastructure\Http\Clients\PurchaseClient;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrders implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        OrderRepositoryInterface $orderRepository,
        RecipeRepositoryInterface $recipeRepository,
        InventoryClient $inventoryClient,
        PurchaseClient $purchaseClient,
        OrdersClient $ordersClient
    ): void
    {
        $orders = $orderRepository->getPendingOrders();

        foreach ($orders as $order) {
            $recipe = $recipeRepository->findById($order['recipe_id']);
            $ingredients = $recipe['ingredients'];

            // Verificar disponibilidad de ingredientes
            $response = $inventoryClient->fetchIngredientsAvailable();
            $allAvailable = true;

            foreach ($ingredients as $name => $quantityRequired) {
                $availableIngredient = collect($response)->firstWhere('name', $name);
                if (!$availableIngredient || $availableIngredient['quantity'] < $quantityRequired) {
                    $allAvailable = false;
                    $purchaseClient->orderIngredients($name, $quantityRequired - ($availableIngredient['quantity'] ?? 0));
                    break;
                }
            }

            // Si todos los ingredientes están disponibles, procesar la orden
            if ($allAvailable) {
                // Actualizar el estado de la orden
                $orderModel = Order::query()->find($order['id']);
                $orderModel->status = 'completed';
                $orderRepository->updateOrder($orderModel);

                // Disminuir la cantidad de ingredientes en la bodega
                $inventoryClient->updateInventory($ingredients);

                $ordersClient->completeOrder($order['id']);
            }
        }
    }
}
