<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\PurchaseRepositoryInterface;

class ListPurchases
{
    private $purchaseRepository;

    public function __construct(PurchaseRepositoryInterface $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function execute(int $perPage = 10)
    {
        return $this->purchaseRepository->paginatePurchases($perPage);
    }
}
