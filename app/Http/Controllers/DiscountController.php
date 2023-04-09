<?php

namespace App\Http\Controllers;

use App\Services\Discount\DiscountService;

class DiscountController extends BaseController
{
    public function __construct(
        public DiscountService $discountService
    ) {}

    public function apply(int $orderId)
    {
        return $this->discountService->apply($orderId);
    }
}
