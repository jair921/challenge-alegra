<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\IngredientRepositoryInterface;

class ViewInventory
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function execute(): array
    {
        return $this->ingredientRepository->all();
    }
}

