<?php

namespace App\Providers;

use App\Domain\Repositories\IngredientRepositoryInterface;
use App\Domain\Repositories\InventoryMovementRepositoryInterface;
use App\Infrastructure\Persistence\EloquentIngredientRepository;
use App\Infrastructure\Persistence\EloquentInventoryMovementRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            IngredientRepositoryInterface::class,
            EloquentIngredientRepository::class
        );

        $this->app->bind(
            InventoryMovementRepositoryInterface::class,
            EloquentInventoryMovementRepository::class
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
