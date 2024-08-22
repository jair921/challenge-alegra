<?php

namespace App\Application\UseCases;

use App\Infrastructure\Http\Clients\KitchenClient;
use App\Domain\Repositories\UserOrderRepositoryInterface;

class CreateUserOrder
{
    private $userOrderRepository;
    private $kitchenClient;

    public function __construct(
        UserOrderRepositoryInterface $userOrderRepository,
        KitchenClient $kitchenClient
    ) {
        $this->userOrderRepository = $userOrderRepository;
        $this->kitchenClient = $kitchenClient;
    }

    public function execute(int $userId)
    {
        // Obtener receta aleatoria
        $recipe = $this->kitchenClient->getRandomRecipe();
        if (!$recipe) {
            return ['success' => false, 'message' => 'Recipe not found'];
        }

        // Crear la orden en la cocina
        $orderResponse = $this->kitchenClient->createOrder($recipe['id']);

        if (!isset($orderResponse['order']['id'])) {
            return ['success' => false, 'message' => 'Failed to create order in kitchen'];
        }

        // Crear la orden para el usuario
        $userOrder = $this->userOrderRepository->createUserOrder($userId, $orderResponse['order']['id']);

        return ['success' => true, 'order' => $orderResponse, 'recipe_name' => $recipe['name']];
    }
}

