<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Dto;

use App\Catalog\Brand\Domain\Dto\BrandDto;
use App\Kernel\Domain\Dto\Dto;

class ProductDto extends Dto
{
    public int $id;
    public int $code;
    public string $name;
    public ?int $brandId;
    public float $price;
    public ?string $description;
    public ?BrandDto $brand;
}
