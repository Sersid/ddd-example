<?php
declare(strict_types=1);

namespace App\Catalog\Product\Infrastructure\Persistence;

use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;
use ReflectionClass;

class InMemoryProductRepository implements IProductRepository
{
    public static array $arProducts = [];

    public function add(Product $product): void
    {
        self::$arProducts[] = $product;

        $reflection = new ReflectionClass($product);
        $id = $reflection->getProperty('id');
        $id->setAccessible(true);
        $id->setValue($product, count(self::$arProducts));
    }
}
