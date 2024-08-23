<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarehouseController extends Controller
{
    public function ingredients()
    {
        $response = Http::get('http://warehouse.test/api/v1/ingredients');
        $ingredients = $response->json();

        return view('warehouse.ingredients', compact('ingredients'));
    }

    public function purchases()
    {
        $response = Http::get('http://purchase.test/api/v1/purchases');
        $purchases = $response->json();

        return view('warehouse.purchases', compact('purchases'));
    }
}
