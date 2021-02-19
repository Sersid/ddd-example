<?php
declare(strict_types=1);

namespace App\Catalog\Product\Infrastructure\Persistence;

use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;

class BitrixProductRepository implements IProductRepository
{
    public function add(Product $product): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }
}
