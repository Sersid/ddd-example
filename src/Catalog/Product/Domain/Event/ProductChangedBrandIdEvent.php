<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Event;

use App\Catalog\Product\Domain\Entity\BrandId;
use App\Catalog\Product\Domain\Entity\Product;

class ProductChangedBrandIdEvent
{
    private Product $product;
    private BrandId $oldBrandId;

    public function __construct(Product $product, BrandId $oldBrandId)
    {
        $this->product = $product;
        $this->oldBrandId = $oldBrandId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getOldBrandId(): BrandId
    {
        return $this->oldBrandId;
    }
}
