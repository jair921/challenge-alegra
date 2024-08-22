<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Recipe;

interface RecipeRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?array;
}
