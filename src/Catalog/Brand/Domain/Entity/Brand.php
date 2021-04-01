<?php
declare(strict_types=1);

namespace App\Catalog\Brand\Domain\Entity;

use App\Catalog\Brand\Domain\Dto\BrandDto;

final class Brand
{
    private BrandId $id;
    private BrandName $name;
    private BrandDescription $description;

    private function __construct()
    {
    }

    public static function create(BrandId $id, BrandName $name, BrandDescription $description): self
    {
        $brand = new self();
        $brand->id = $id;
        $brand->name = $name;
        $brand->description = $description;

        return $brand;
    }

    public static function restore(BrandDto $dto): self
    {
        $brand = new self();
        $brand->id = new BrandId($dto->id);
        $brand->name = new BrandName($dto->name);
        $brand->description = new BrandDescription($dto->description);

        return $brand;
    }

    public function getId(): BrandId
    {
        return $this->id;
    }

    public function getName(): BrandName
    {
        return $this->name;
    }

    public function getDescription(): BrandDescription
    {
        return $this->description;
    }
}
