<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Dto;

class ProductDto
{
    public int $id;
    public int $code;
    public string $name;
    public ?int $brandId;
    public float $price;
    public ?string $description;
}
