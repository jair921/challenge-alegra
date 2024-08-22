<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\RecipeRepositoryInterface;

class GetRecipeById
{
    private $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function execute(int $id)
    {
        $recipe = $this->recipeRepository->findById($id);

        if (!$recipe) {
            return null; // Or throw an exception if preferred
        }

        return $recipe;
    }
}
