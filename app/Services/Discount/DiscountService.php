<?php

namespace App\Services\Discount;

use App\Repositories\Discount\DiscountRepositoryInterface;

class DiscountService implements DiscountServiceInterface
{
    /**
     * @param DiscountRepositoryInterface $discountRepository
     */
    public function __construct(
       public DiscountRepositoryInterface $discountRepository
    ) {}

    /**
     * @param int $orderId
     * @return mixed
     */
    public function apply(int $orderId)
    {
        return $this->discountRepository->apply($orderId);
    }
}
