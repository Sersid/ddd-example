<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Event;

use App\Catalog\Product\Domain\Entity\Price;
use App\Catalog\Product\Domain\Entity\Product;

class ProductChangedPriceEvent
{
    private Product $product;
    private Price $oldPrice;

    public function __construct(Product $product, Price $oldPrice)
    {
        $this->product = $product;
        $this->oldPrice = $oldPrice;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getOldPrice(): Price
    {
        return $this->oldPrice;
    }
}
