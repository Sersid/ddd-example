<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Event;

use App\Catalog\Product\Domain\Entity\Product;

class ProductChangedBrandIdEvent
{
    private Product $product;
    private ?int $oldBrandId;

    public function __construct(Product $product, ?int $oldBrandId)
    {
        $this->product = $product;
        $this->oldBrandId = $oldBrandId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getOldBrandId(): ?int
    {
        return $this->oldBrandId;
    }
}
