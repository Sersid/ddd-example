<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Exception\ProductNotFound;

interface IProductRepository
{
    public function add(Product $product): void;

    /**
     * @param Id $id
     *
     * @return Product
     * @throws ProductNotFound
     */
    public function getById(Id $id): Product;

    public function update(Product $product): void;

    public function delete(Id $id): void;
}
