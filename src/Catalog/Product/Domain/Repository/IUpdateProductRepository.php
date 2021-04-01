<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Repository;

use App\Catalog\Product\Domain\Entity\Product;

interface IUpdateProductRepository
{
    public function __invoke(Product $product): void;
}
