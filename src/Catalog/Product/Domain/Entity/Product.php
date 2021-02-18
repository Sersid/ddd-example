<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

class Product
{
    private int $id;
    private int $code;
    private string $name;
    private string $brand;
    private float $price;
    private ?string $description;

    public function __construct(int $code, string $name, string $brand, float $price, ?string $description)
    {
        $this->code = $code;
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
