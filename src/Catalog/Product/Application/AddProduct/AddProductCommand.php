<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\AddProduct;

class AddProductCommand
{
    public int $code;
    public string $name;
    public string $brand;
    public float $price;
    public ?string $description;
}
