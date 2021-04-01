<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Repository;

use App\Catalog\Product\Domain\Entity\Id;

interface IDeleteProductRepository
{
    public function __invoke(Id $id): void;
}
