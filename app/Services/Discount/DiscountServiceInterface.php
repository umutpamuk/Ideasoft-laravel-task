<?php

namespace App\Services\Discount;

interface DiscountServiceInterface
{
    public function apply(int $orderId);

}
