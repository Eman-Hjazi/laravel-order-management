<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Order\Models\Order;
use Domain\Order\DataTransferObjects\OrderData;
use Domain\Order\Actions\CreateOrderAction;
use Domain\Order\Repositories\OrderRepositoryInterface;
use Domain\Order\Events\OrderPlaced;
use App\Http\Resources\OrderResource;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class OrderController
 *
 * This controller acts as the entry point for HTTP requests related to Orders.
 * It follows the "Thin Controller" principle, delegating all business logic
 * to the Domain layer (Actions) and data access to Repositories.
 */
class OrderController extends Controller
{
    /**
     * @param CreateOrderAction $createOrderAction The domain action to handle creation logic.
     * @param OrderRepositoryInterface $orderRepository The repository to handle persistence.
     */
    public function __construct(
        protected CreateOrderAction $createOrderAction,
        protected OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * Store a newly created order.
     *
     * Workflow:
     * 1. Validate request through CreateOrderRequest.
     * 2. Transform request into a type-safe DTO.
     * 3. Execute the domain action.
     * 4. Dispatch the domain event.
     * 5. Return a structured JSON response via an API Resource.
     */
    public function store(CreateOrderRequest $request): JsonResponse
    {
        // Convert input data into a structured DTO
        $data = OrderData::fromRequest($request);

        // Delegate process to the domain action
        $order = $this->createOrderAction->execute($data);

        // Trigger side effects via domain events
        event(new OrderPlaced($order));

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => new OrderResource($order)
        ], 201);
    }

    /**
     * Display a listing of orders.
     */
    public function index(): JsonResponse
    {
        // Retrieve data via Repository, ensuring domain isolation
        $orders = $this->orderRepository->all();

        return response()->json([
            'success' => true,
            'data' => OrderResource::collection($orders)
        ]);
    }

    /**
     * Remove the specified order.
     */
    public function destroy(Order $order): JsonResponse
    {
        // Persistence logic is hidden behind the repository
        $this->orderRepository->delete($order);

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    }
}
