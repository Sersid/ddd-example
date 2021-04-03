<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Repository;

use App\Catalog\Product\Domain\Dto\ProductDto;

interface IFindProductDtoRepository
{
    public function __invoke(int $id): ProductDto;
}
