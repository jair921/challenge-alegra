<?php

namespace App\Jobs;

use App\Domain\Repositories\PurchaseRepositoryInterface;
use App\Infrastructure\Http\Clients\InventoryClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessPendingPurchases implements ShouldQueue
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
    public function handle(PurchaseRepositoryInterface $purchaseRepository, InventoryClient $inventoryClient)
    {
        // Obtener todas las compras pendientes
        $pendingPurchases = $purchaseRepository->findPendingPurchases();

        foreach ($pendingPurchases as $purchase) {
            $ingredientName = $purchase->ingredient_name;
            $quantityRequested = $purchase->quantity;
            $quantityPurchased = 0;

            while ($quantityPurchased < $quantityRequested) {
                $response = Http::get("https://recruitment.alegra.com/api/farmers-market/buy", [
                    'ingredient' => $ingredientName,
                ])->json();

                $quantitySold = $response['quantitySold'] ?? 0;
                $quantityPurchased += $quantitySold;

                // Actualizar el estado de la compra si se completó
                if ($quantityPurchased >= $quantityRequested) {
                    $purchaseRepository->updatePurchaseStatus($purchase->id, 'completed');

                    // Actualizar el inventario en Warehouse
                    $inventoryClient->addIngredients([
                        'ingredients' => [
                            [
                                'name' => $ingredientName,
                                'quantity' => $quantityRequested,
                            ]
                        ]
                    ]);

                    break;
                }
            }

            // Si no se completó la compra, actualizar la cantidad pendiente
            if ($quantityPurchased < $quantityRequested) {
                $purchaseRepository->updatePurchaseQuantity($purchase->id, $quantityPurchased);
            }
        }
    }
}
