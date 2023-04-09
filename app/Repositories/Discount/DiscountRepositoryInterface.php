<?php

namespace App\Repositories\Discount;

interface DiscountRepositoryInterface
{
    /**
     * @param int $orderId
     * @return mixed
     */
    public function apply(int $orderId);
}
