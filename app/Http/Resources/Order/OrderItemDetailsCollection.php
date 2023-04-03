<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderItemDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return $this->collection->transform(function($orderItem){
            return [
                'productId' => $orderItem->product_id,
                'quantity' => $orderItem->quantity,
                'unitPrice' => $orderItem->unit_price,
                'total' => $orderItem->total,
            ];
        });
    }
}
