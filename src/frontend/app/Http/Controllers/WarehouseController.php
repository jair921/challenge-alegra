<?php

namespace App\Http\Controllers;

use App\Http\Clients\GatewayClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarehouseController extends Controller
{
    public function ingredients(GatewayClient $gatewayClient)
    {
        $ingredients = $gatewayClient->fetchIngredients();

        return view('warehouse.ingredients', compact('ingredients'));
    }

    public function purchases(GatewayClient $gatewayClient)
    {
        $purchases = $gatewayClient->fetchPurchases();

        return view('warehouse.purchases', compact('purchases'));
    }
}
