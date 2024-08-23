<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KitchenController extends Controller
{
    protected $kitchenService;

    public function __construct()
    {
        $this->kitchenService = config('services.kitchen.endpoint');
    }

    public function ramdon(Request $request)
    {
        // Forward la solicitud al servicio de órdenes
        $response = Http::get("{$this->kitchenService}/api/v1/recipes/random");

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }

    public function recipes(Request $request)
    {
        // Forward la solicitud al servicio de órdenes
        $response = Http::get("{$this->kitchenService}/api/v1/recipes");

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }

    public function recipe(Request $request, $recipe)
    {
        // Forward la solicitud al servicio de órdenes
        $response = Http::get("{$this->kitchenService}/api/v1/recipes/{$recipe}");

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }

    public function order(Request $request, $order)
    {
        // Forward la solicitud al servicio de órdenes
        $response = Http::get("{$this->kitchenService}/api/v1/orders/{$order}");

        // Retornar la respuesta del servicio de órdenes al cliente
        return response()->json($response->json(), $response->status());
    }

}
