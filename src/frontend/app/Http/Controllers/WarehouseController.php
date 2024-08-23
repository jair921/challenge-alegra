<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
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

    public function purchases(Request $request, GatewayClient $gatewayClient)
    {
        $page = $request->has('page') ? $request->page : 1;
        $purchases = $gatewayClient->fetchPurchases($page);

        $purchases = Helpers::replacePaginationUrls($purchases, route('warehouse.purchases'));

        return view('warehouse.purchases', compact('purchases'));
    }
}
