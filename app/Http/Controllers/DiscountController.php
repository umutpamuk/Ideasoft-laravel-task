<?php

namespace App\Http\Controllers;

use App\Services\Repositories\DiscountRepository;
use Illuminate\Http\JsonResponse;

class DiscountController extends BaseController
{
    /**
     * @var DiscountRepository
     */
    private DiscountRepository $discountRepository;

    /**
     * @param DiscountRepository $discountRepository
     */
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @param int $orderId
     * @return JsonResponse
     */
    public function apply(int $orderId) : JsonResponse
    {
        return $this->discountRepository->apply($orderId);
    }
}
