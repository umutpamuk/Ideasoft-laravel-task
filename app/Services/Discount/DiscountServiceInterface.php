<?php

namespace App\Services\Discount;

interface DiscountServiceInterface
{
    /**
     * @param int $orderId
     * @return mixed
     */
    public function apply(int $orderId);

}
