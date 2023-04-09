<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'productId' => $this->product_id,
            'quantity' => $this->quantity,
            'unitPrice' => $this->unit_price,
            'total' => $this->total,
        ];
    }
}
