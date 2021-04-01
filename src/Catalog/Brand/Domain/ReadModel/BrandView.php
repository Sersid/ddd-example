<?php
declare(strict_types=1);

namespace App\Catalog\Brand\Domain\ReadModel;

use App\Catalog\Brand\Domain\Dto\BrandDto;

class BrandView
{
    private BrandDto $dto;

    public function __construct(BrandDto $dto)
    {
        $this->dto = $dto;
    }

    public function id(): int
    {
        return $this->dto->id;
    }

    public function name(): string
    {
        return $this->dto->name;
    }

    public function description(): ?string
    {
        return $this->dto->description;
    }

    public function url(): string
    {
        return '/brand/?id=' . $this->id();
    }
}
