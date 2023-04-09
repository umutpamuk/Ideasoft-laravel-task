<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Services\Order\OrderService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends BaseController
{

    /**
     * @param OrderService $orderService
     */
    public function __construct(
        public OrderService $orderService
    )
    {}

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
       return $this->orderService->all();
    }


    /**
     * @param OrderStoreRequest $request
     * @return OrderResource
     */
    public function store(OrderStoreRequest $request): OrderResource
    {
        return $this->orderService->store($request);
    }


    /**
     * @param int $id
     * @return OrderResource
     */
    public function destroy(int $id) : OrderResource
    {
        return $this->orderService->destroy($id);
    }
}
