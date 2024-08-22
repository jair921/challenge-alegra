<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Ingredient;
use App\Domain\Repositories\IngredientRepositoryInterface;
use App\Models\Ingredient as IngredientModel;

class EloquentIngredientRepository implements IngredientRepositoryInterface
{
    public function findByName(string $name): ?Ingredient
    {
        $ingredientModel = IngredientModel::where('name', $name)->first();
        if ($ingredientModel) {
            return new Ingredient($ingredientModel->id, $ingredientModel->name, $ingredientModel->quantity);
        }
        return null;
    }

    public function save(Ingredient $ingredient): void
    {
        $ingredientModel = IngredientModel::updateOrCreate(
            ['name' => $ingredient->getName()],
            ['quantity' => $ingredient->getQuantity()]
        );
        $ingredientModel->save();
    }

    public function all(): array
    {
        return IngredientModel::all()->map(function ($model) {
            return (new Ingredient(
                $model->id,
                $model->name,
                $model->quantity)
            )->toArray();
        })->toArray();
    }
}

