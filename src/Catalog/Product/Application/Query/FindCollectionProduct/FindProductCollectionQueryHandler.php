<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\Query\FindCollectionProduct;

use App\Catalog\Product\Domain\Repository\IProductRepository;
use App\Catalog\Product\Domain\ReadModel\ProductViewCollection;

class FindProductCollectionQueryHandler
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(FindProductCollectionQuery $query): ProductViewCollection
    {
        return $this->productRepository->findCollection();
    }
}
