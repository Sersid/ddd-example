<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\UpdateProduct;

class UpdateProductCommand
{
    public int $id;
    public string $name;
    public string $brand;
    public ?int $brandId;
    public float $price;
    public ?string $description;
}
