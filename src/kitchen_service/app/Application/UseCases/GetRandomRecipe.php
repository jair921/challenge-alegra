<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\RecipeRepositoryInterface;

class GetRandomRecipe
{
    private $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function execute(): array
    {
        $recipes = $this->recipeRepository->findAll();
        if (empty($recipes)) {
            throw new \Exception('No recipes available');
        }

        $randomRecipe = $recipes[array_rand($recipes)];
        return [
            'id' => $randomRecipe['id'],
            'name' => $randomRecipe['name'],
            'ingredients' => $randomRecipe['ingredients'],
        ];
    }
}
