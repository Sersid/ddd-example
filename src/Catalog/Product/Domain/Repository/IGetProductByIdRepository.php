<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Repository;

use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Entity\Product;

interface IGetProductByIdRepository
{
    public function __invoke(Id $id): Product;
}
