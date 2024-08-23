<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Clients\GatewayClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KitchenController extends Controller
{
    public function orders(Request $request, GatewayClient $gatewayClient)
    {
        $page = $request->has('page') ? $request->page : 1;
        $orders = $gatewayClient->fetchOrders($page);

        foreach($orders['data'] as $i => $order)
        {
            $orderId = $order['order_id'];
            $orderKitchen = $gatewayClient->fetchOrderKitchen($orderId);
            $recipe = $gatewayClient->fetchRecipe($orderKitchen['recipe_id']);

            $orders['data'][$i]['recipe'] = $recipe['recipe']['name'];
        }

        $orders = Helpers::replacePaginationUrls($orders, route('kitchen.orders'));

        return view('kitchen.order', compact('orders'));
    }
}
