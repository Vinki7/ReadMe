<?php

namespace App\Providers;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(ProductRepository::class, function ($app) {
            return new ProductRepository();
        });

        $this->app->singleton(CartRepository::class, function ($app) {
            return new CartRepository();
        });

        $this->app->singleton(OrderRepository::class, function ($app) {
            return new OrderRepository();
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
            return new CheckoutService(
                $app->make(CartService::class),
                $app->make(ProductService::class),
                $app->make(OrderRepository::class),
                $app->make(UserRepository::class)
            );
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
