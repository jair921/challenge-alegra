<?php

namespace App\Http\Controllers;

use App\Http\Clients\GatewayClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KitchenController extends Controller
{
    public function orders(GatewayClient $gatewayClient)
    {
        $orders = $gatewayClient->fetchOrders();

        return view('kitchen.order', compact('orders'));
    }
}
