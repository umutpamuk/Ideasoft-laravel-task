<?php

namespace App\Repositories\Discount;

interface DiscountRepositoryInterface
{
    public function apply(int $orderId);
}
