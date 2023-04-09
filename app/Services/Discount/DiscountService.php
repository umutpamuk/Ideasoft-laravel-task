<?php

namespace App\Services\Discount;

use App\Repositories\Discount\DiscountRepositoryInterface;

class DiscountService implements DiscountServiceInterface
{
    public function __construct(
       public DiscountRepositoryInterface $discountRepository
    ) {}

    public function apply(int $orderId)
    {
        return $this->discountRepository->apply($orderId);
    }
}
