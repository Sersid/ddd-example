<?php
declare(strict_types=1);

namespace App\Catalog\Product\Infrastructure\Persistence;

use App\Catalog\Product\Domain\Entity\ProductId;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;

class BitrixProductRepository implements IProductRepository
{
    public function add(Product $product): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    /**
     * @param ProductId $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(ProductId $id): Product
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    public function update(Product $product): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }

    public function delete(ProductId $id): void
    {
        // у меня не было желания писать реализацию на Битриксе
    }
}
