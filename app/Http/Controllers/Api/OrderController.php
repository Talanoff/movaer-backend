<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request): JsonResponse
    {
        //
    }

    public function update(OrderUpdateRequest $request, Order $order): JsonResponse
    {
        //
    }
}
