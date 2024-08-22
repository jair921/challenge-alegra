<?php

namespace App\Providers;

use App\Domain\Repositories\PurchaseRepositoryInterface;
use App\Infrastructure\Persistence\EloquentPurchaseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PurchaseRepositoryInterface::class,
            EloquentPurchaseRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
