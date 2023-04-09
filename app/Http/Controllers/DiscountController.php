<?php

namespace App\Http\Controllers;

use App\Services\Discount\DiscountService;
use Illuminate\Http\JsonResponse;

class DiscountController extends BaseController
{
    /**
     * @param DiscountService $discountService
     */
    public function __construct(
        public DiscountService $discountService
    ) {}


    /**
     * @param int $orderId
     * @return JsonResponse
     */
    public function apply(int $orderId) : JsonResponse
    {
        $applyDiscount = $this->discountService->apply($orderId);

        if ($applyDiscount) {
            return $this->jsonResponse($applyDiscount);
        } else {
            return $this->jsonResponse(null,404);
        }
    }
}
