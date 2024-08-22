<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\CreateUserOrder;
use App\Application\UseCases\ListUserOrders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    private $createUserOrder;
    private $listUserOrders;

    public function __construct(CreateUserOrder $createUserOrder, ListUserOrders $listUserOrders)
    {
        $this->createUserOrder = $createUserOrder;
        $this->listUserOrders = $listUserOrders;
    }

    public function create(Request $request)
    {
        $response = $this->createUserOrder->execute($request->user_id);

        if (!$response['success']) {
            return response()->json($response, 400);
        }

        return response()->json($response);
    }

    public function index(Request $request)
    {
        $orders = $this->listUserOrders->execute(
            $request->query('user_id', 1),
            $request->query('per_page', 10)
        );

        return response()->json($orders);
    }
}
