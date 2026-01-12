<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\DTOs\OrderData;
use App\Models\Product;
use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Actions\CreateOrderAction;
use App\Http\Resources\OrderResource;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{
    public function __construct(protected CreateOrderAction $createOrderAction) {}

    public function store(CreateOrderRequest $request)
    {
        $data = new OrderData($request->validated());

        $order = $this->createOrderAction->execute($data);

        event(new OrderPlaced($order));

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Order created successfully',
            'data' => new OrderResource($order)
        ], 201);
    }

    public function index()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Orders retrieved successfully',
            'data' => OrderResource::collection($orders)
        ], 200);
    }

    public function show(Order $order)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Order retrieved successfully',
            'data' => new OrderResource($order->load(['user', 'product']))
        ], 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
