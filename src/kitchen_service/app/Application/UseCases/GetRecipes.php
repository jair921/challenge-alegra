<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\RecipeRepositoryInterface;

class GetRecipes
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function execute(): array
    {
        return $this->recipeRepository->findAll();
    }
}
