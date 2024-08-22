<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Purchase;
use App\Domain\Repositories\PurchaseRepositoryInterface;

class CreatePurchase
{
    private $purchaseRepository;

    public function __construct(PurchaseRepositoryInterface $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function execute(array $data): Purchase
    {
        $purchase = new Purchase(
            $data['ingredient_name'],
            $data['quantity'],
            new \DateTime(),
            'pending'
        );

        return $this->purchaseRepository->create($purchase);
    }
}

