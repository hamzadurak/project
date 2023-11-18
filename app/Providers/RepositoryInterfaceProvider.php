<?php

namespace App\Providers;

use App\Http\Controllers\Offer\Contracts\OfferInterface;
use App\Http\Controllers\Offer\Repositories\OfferRepository;
use App\Http\Controllers\Order\Contracts\OrderInterface;
use App\Http\Controllers\Order\Repositories\OrderRepository;
use App\Http\Controllers\Product\Contracts\ProductInterface;
use App\Http\Controllers\Product\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryInterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            OrderInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            OfferInterface::class,
            OfferRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
