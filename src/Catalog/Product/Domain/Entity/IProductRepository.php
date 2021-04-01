<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Exception\ProductNotFoundException;

interface IProductRepository
{
    public function add(Product $product): void;

    /**
     * @param ProductId $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(ProductId $id): Product;

    public function update(Product $product): void;

    public function delete(ProductId $id): void;
}
