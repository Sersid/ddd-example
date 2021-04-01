<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\ReadModel;

use App\Catalog\Brand\Domain\ReadModel\BrandView;
use App\Catalog\Product\Domain\Dto\ProductDto;

class ProductView
{
    private ProductDto $dto;
    private ?BrandView $brand;

    public function __construct(ProductDto $dto)
    {
        $this->dto = $dto;
        $this->brand = $dto->brand === null ? null : new BrandView($dto->brand);
    }

    public function code(): int
    {
        return $this->dto->code;
    }

    public function name(): string
    {
        return $this->dto->name;
    }

    public function hasDescription(): bool
    {
        return $this->dto->description !== null;
    }

    public function description(): ?string
    {
        return $this->dto->description;
    }

    public function url(): string
    {
        return '/zakaz/' . $this->code() . '/';
    }

    public function hasBrand(): bool
    {
        return $this->brand !== null;
    }

    public function brand(): BrandView
    {
        return $this->brand;
    }
}
