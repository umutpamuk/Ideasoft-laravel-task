<?php

namespace App\Services\Order;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface OrderServiceInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function all();

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
