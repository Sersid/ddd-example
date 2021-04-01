<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Event;

use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Product;

class ProductRenamedEvent
{
    private Product $product;
    private Name $oldName;

    public function __construct(Product $product, Name $oldName)
    {
        $this->product = $product;
        $this->oldName = $oldName;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getOldName(): Name
    {
        return $this->oldName;
    }
}
