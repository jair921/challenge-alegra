<?php

namespace App\Providers;

use App\Domain\Repositories\UserOrderRepositoryInterface;
use App\Infrastructure\Persistence\EloquentUserOrderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserOrderRepositoryInterface::class,
            EloquentUserOrderRepository::class
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
