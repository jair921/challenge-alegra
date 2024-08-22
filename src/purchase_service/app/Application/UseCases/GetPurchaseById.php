<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\PurchaseRepositoryInterface;

class GetPurchaseById
{
    private $purchaseRepository;

    public function __construct(PurchaseRepositoryInterface $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function execute(int $id)
    {
        return $this->purchaseRepository->findById($id);
    }
}
