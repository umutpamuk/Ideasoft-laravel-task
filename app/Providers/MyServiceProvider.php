<?php

namespace App\Providers;


use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderService;
use App\Repositories\Order\OrderServiceInterface;
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

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
