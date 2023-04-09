<?php

namespace App\Providers;


use App\Repositories\Discount\DiscountRepository;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Discount\DiscountService;
use App\Services\Discount\DiscountServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       app()->bind(OrderServiceInterface::class, OrderService::class);
       app()->bind(OrderRepositoryInterface::class, OrderRepository::class);

       app()->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
       app()->bind(DiscountServiceInterface::class, DiscountService::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
