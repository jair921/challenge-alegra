<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Ingredient;

interface IngredientRepositoryInterface
{
    public function findByName(string $name): ?Ingredient;
    public function save(Ingredient $ingredient): void;
    public function all(): array;
}
