<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\ReadModel;

use App\Kernel\Domain\Collection\Collection;

class ProductViewCollection extends Collection
{
    protected static function type(): string
    {
        return ProductView::class;
    }
}
