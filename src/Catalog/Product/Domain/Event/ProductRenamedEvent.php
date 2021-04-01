<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Event;

use App\Catalog\Product\Domain\Entity\Product;

class ProductRenamedEvent
{
    private Product $product;
    private string $oldName;

    public function __construct(Product $product, string $oldName)
    {
        $this->product = $product;
        $this->oldName = $oldName;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getOldName(): string
    {
        return $this->oldName;
    }
}
