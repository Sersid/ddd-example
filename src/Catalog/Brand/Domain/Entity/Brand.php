<?php
declare(strict_types=1);

namespace App\Catalog\Brand\Domain\Entity;

use App\Catalog\Brand\Domain\Dto\BrandDto;

final class Brand
{
    private Id $id;
    private Name $name;
    private Description $description;

    private function __construct()
    {
    }

    public static function create(Id $id, Name $name, Description $description): self
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
        $brand->id = new Id($dto->id);
        $brand->name = new Name($dto->name);
        $brand->description = new Description($dto->description);

        return $brand;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }
}
