<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Exception\ProductNotFound;

interface IProductRepository
{
    public function add(Product $product): void;

    /**
     * @param int $id
     *
     * @return Product
     * @throws ProductNotFound
     */
    public function getById(int $id): Product;

    public function update(Product $product): void;
}
