<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\Command\AddProduct;

class AddProductCommand
{
    public int $code;
    public string $name;
    public ?int $brandId;
    public float $price;
    public ?string $description;
}
