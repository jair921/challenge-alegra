<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\CreateOrder;
use App\Application\UseCases\PrepareOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $createOrderUseCase;
    private $prepareOrderUseCase;

    public function __construct(CreateOrder $createOrderUseCase, PrepareOrder $prepareOrderUseCase)
    {
        $this->createOrderUseCase = $createOrderUseCase;
        $this->prepareOrderUseCase = $prepareOrderUseCase;
    }

    public function createOrder(Request $request)
    {
        $validatedData = $request->validate([
            'recipe_id' => 'required|integer|exists:recipes,id',
        ]);

        $result = $this->createOrderUseCase->execute($validatedData['recipe_id']);

        if ($result['success']) {
            return response()->json(['order' => $result['order']], 201);
        }

        return response()->json(['message' => $result['message']], 400);
    }

    public function prepareOrder(Request $request, Order $order)
    {
        try {
            $order = $this->prepareOrderUseCase->execute($order);
            return response()->json(['order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
