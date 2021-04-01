<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Repository;

use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;

interface IProductRepository
{
    public function add(Product $product): void;

    /**
     * @param Id $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(Id $id): Product;

    public function update(Product $product): void;

    public function delete(Id $id): void;
}
