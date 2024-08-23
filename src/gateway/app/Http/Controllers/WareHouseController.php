<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WareHouseController extends Controller
{

    public function __construct()
    {
        $this->ordersServiceUrl = config('services.warehouse.endpoint');
        $this->purchaseServiceUrl = config('services.purchase.endpoint');
    }

    public function ingredients()
    {
        $response = Http::get("{$this->ordersServiceUrl}/api/v1/ingredients");

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }

    public function purchases(Request $request)
    {
        $page = $request->has('page') ? $request->page : 1;
        $response = Http::get("{$this->purchaseServiceUrl}/api/v1/purchases", ['page' => $page]);

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }
}
