<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Event;

use App\Catalog\Product\Domain\Entity\Product;

class ProductCreatedEvent
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
