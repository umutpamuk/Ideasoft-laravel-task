<?php

namespace App\Services\Order;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderService implements OrderServiceInterface
{

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        public OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
      return $this->orderRepository->all();
    }

    /**
     * @param OrderStoreRequest $request
     * @return OrderResource
     */
    public function store(OrderStoreRequest $request): OrderResource
    {
        return $this->orderRepository->store($request);
    }

    /**
     * @param int $id
     * @return OrderResource
     */
    public function destroy(int $id): OrderResource
    {
        return $this->orderRepository->destroy($id);
    }

}
