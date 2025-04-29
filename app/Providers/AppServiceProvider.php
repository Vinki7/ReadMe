<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Services\CartService;
use App\Repositories\CartRepository;
use App\Services\CheckoutService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(ProductRepository::class, function ($app) {
            return new ProductRepository();
        });

        $this->app->singleton(CartRepository::class, function ($app) {
            return new CartRepository();
        });

        // Register the CartService as a singleton
        $this->app->singleton(CartService::class, function ($app) {
            return new CartService(
                $app->make(ProductRepository::class),
                $app->make(CartRepository::class)
            );
        });

        // Register the ProductService as a singleton
        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepository::class));
        });

        // Register the CheckoutService as a singleton
        $this->app->singleton(CheckoutService::class, function ($app) {
            return new CheckoutService();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('screenSize', session('screenSize', null));
        });
    }
}
