<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WareHouseController extends Controller
{

    public function __construct()
    {
        $this->ordersServiceUrl = config('services.warehouse.endpoint');
    }

    public function ingredients()
    {
        $response = Http::get("{$this->ordersServiceUrl}/api/v1/ingredients");

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }
}
