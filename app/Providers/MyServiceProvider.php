<?php

namespace App\Providers;

use App\Services\Interfaces\DiscountInterface;
use App\Services\Repositories\DiscountRepository;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(DiscountInterface::class, DiscountRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
