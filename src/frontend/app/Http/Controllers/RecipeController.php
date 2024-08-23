<?php

namespace App\Http\Controllers;

use App\Http\Clients\GatewayClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    public function index(GatewayClient $gatewayClient)
    {
        $recipes = $gatewayClient->fetchRecipes();

        return view('recipes.index', compact('recipes'));
    }

    public function createOrder(GatewayClient $gatewayClient)
    {
        $order = $gatewayClient->createOrders();

        return redirect()->route('kitchen.orders')->with('order', $order);
    }

}
