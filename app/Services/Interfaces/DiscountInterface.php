<?php

namespace App\Services\Interfaces;

use Illuminate\Http\JsonResponse;

interface DiscountInterface
{
    /**
     * @param int $orderId
     * @return JsonResponse
     */
    public function apply(int $orderId) : JsonResponse;

}
