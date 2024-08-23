<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\CreatePurchase;
use App\Application\UseCases\GetPurchaseById;
use App\Application\UseCases\ListPurchases;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    private $createPurchase;
    private $getPurchaseById;
    private $listPurchases;

    public function __construct(
        CreatePurchase $createPurchase,
        GetPurchaseById $getPurchaseById,
        ListPurchases $listPurchases
    )
    {
        $this->createPurchase = $createPurchase;
        $this->getPurchaseById = $getPurchaseById;
        $this->listPurchases = $listPurchases;
    }

    public function index(Request $request)
    {
        $purchases = $this->listPurchases->execute();

        return response()->json($purchases);
    }

    public function store(Request $request)
    {
        $purchase = $this->createPurchase->execute($request->all());

        return response()->json($purchase->toArray(), 201);
    }

    public function show(int $id)
    {
        $purchase = $this->getPurchaseById->execute($id);

        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }

        return response()->json($purchase->toArray());
    }

}
