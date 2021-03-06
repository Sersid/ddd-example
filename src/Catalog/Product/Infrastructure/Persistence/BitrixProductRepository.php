<?php
declare(strict_types=1);

namespace App\Catalog\Product\Infrastructure\Persistence;

use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Repository\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;
use App\Catalog\Product\Domain\ReadModel\ProductViewCollection;

class BitrixProductRepository implements IProductRepository
{
    public function add(Product $product): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    /**
     * @param Id $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(Id $id): Product
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    public function update(Product $product): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    public function delete(Id $id): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    public function findCollection(): ProductViewCollection
    {
        // у меня не было желания писать реализацию на Битриксе
    }
}
