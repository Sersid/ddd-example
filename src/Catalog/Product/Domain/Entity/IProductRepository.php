<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

interface IProductRepository
{
    public function add(Product $product): void;
}
