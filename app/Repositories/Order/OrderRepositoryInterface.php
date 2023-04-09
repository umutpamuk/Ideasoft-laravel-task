<?php

namespace App\Repositories\Order;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface OrderRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function all() : AnonymousResourceCollection;

    /**
     * @param OrderStoreRequest $request
     * @return OrderResource
     */
    public function store(OrderStoreRequest $request) : OrderResource;

    /**
     * @param int $id
     * @return OrderResource
     */
    public function destroy(int $id) : OrderResource;
}
