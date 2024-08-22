<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\AddIngredients;
use App\Application\UseCases\OrderIngredients;
use App\Application\UseCases\RecordInventoryMovement;
use App\Application\UseCases\ViewInventory;
use App\Infrastructure\Http\Request\OrderIngredientsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IngredientController extends Controller
{
    private $orderIngredients;
    private $addIngredients;
    private $viewInventory;
    private $recordInventoryMovement;

    public function __construct(
        OrderIngredients $orderIngredients,
        AddIngredients $addIngredients,
        ViewInventory $viewInventory,
        RecordInventoryMovement $recordInventoryMovement
    ) {
        $this->orderIngredients = $orderIngredients;
        $this->addIngredients = $addIngredients;
        $this->viewInventory = $viewInventory;
        $this->recordInventoryMovement = $recordInventoryMovement;
    }

    public function index()
    {
        return response()->json($this->viewInventory->execute());
    }

    public function order(OrderIngredientsRequest $request)
    {
        try {
            $this->orderIngredients->execute($request->all());
            $this->recordInventoryMovement->execute($request->all(), 'remove');

            return response()->json(['message' => 'Order placed successfully']);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function add(OrderIngredientsRequest $request)
    {
        try {
            $this->addIngredients->execute($request->all());
            $this->recordInventoryMovement->execute($request->all(), 'add');

            return response()->json(['message' => 'Add ingredient successfully']);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
