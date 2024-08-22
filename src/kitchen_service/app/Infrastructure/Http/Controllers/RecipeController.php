<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\GetRandomRecipe;
use App\Application\UseCases\GetRecipeById;
use App\Application\UseCases\GetRecipes;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    private GetRecipes $getRecipes;
    private $getRecipeById;
    private $getRandomRecipe;

    public function __construct(
        GetRecipes $getRecipes,
        GetRecipeById $getRecipeById,
        GetRandomRecipe $getRandomRecipe)
    {
        $this->getRecipes = $getRecipes;
        $this->getRecipeById  = $getRecipeById;
        $this->getRandomRecipe = $getRandomRecipe;
    }

    public function index()
    {
        return response()->json($this->getRecipes->execute());
    }

    public function show($id)
    {
        $recipe = $this->getRecipeById->execute($id);

        if ($recipe) {
            return response()->json(['recipe' => $recipe]);
        }

        return response()->json(['message' => 'Recipe not found'], 404);
    }

    public function getRandom()
    {
        try {
            $recipe = $this->getRandomRecipe->execute();
            return response()->json($recipe);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
