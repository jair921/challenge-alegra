<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    protected $ordersServiceUrl;

    public function __construct()
    {
        $this->ordersServiceUrl = config('services.orders.endpoint');
    }

    public function createOrder(Request $request)
    {
        // Forward la solicitud al servicio de órdenes
        $response = Http::post("{$this->ordersServiceUrl}/api/v1/orders", $request->all());

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }

    public function listOrders(Request $request)
    {
        $page = $request->has('page') ? $request->page : 1;
        // Forward la solicitud al servicio de órdenes
        $response = Http::get("{$this->ordersServiceUrl}/api/v1/orders", ['page' => $page]);

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }
}
