<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\IngredientRepositoryInterface;

class AddIngredients
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function execute(array $ingredientData): void
    {
        foreach ($ingredientData['ingredients'] as $data) {
            $ingredient = $this->ingredientRepository->findByName($data['name']);
            if ($ingredient) {
                $ingredient->increaseQuantity($data['quantity']);
                $this->ingredientRepository->save($ingredient);
            } else {
                throw new \InvalidArgumentException('Ingredient not found: ' . $data['name']);
            }
        }
    }
}
