<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Recipe;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Models\Recipe as RecipeModel;

class EloquentRecipeRepository implements RecipeRepositoryInterface
{
    public function findAll(): array
    {
        return RecipeModel::all()->map(function ($model) {
            return (new Recipe($model->id, $model->name, json_decode($model->ingredients, true)))->toArray();
        })->toArray();
    }

    public function findById(int $id): ?array
    {
        $model = RecipeModel::find($id);
        return $model ?
            (new Recipe($model->id, $model->name, json_decode($model->ingredients, true)) )->toArray()
            : null;
    }
}
