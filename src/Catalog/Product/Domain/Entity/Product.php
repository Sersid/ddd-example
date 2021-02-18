<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use Webmozart\Assert\Assert;

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
        Assert::range($code, 100000, 999999);
        
        $name = trim($name);
        Assert::notEmpty($name);
        Assert::maxLength($name, 255);

        $brand = trim($brand);
        Assert::notEmpty($brand);
        Assert::maxLength($brand, 255);
        
        Assert::greaterThan($price, 0);

        if (!is_null($description)) {
            $description = trim($description);
            Assert::notEmpty($description);
        }
        
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

    public function setName(string $name): void
    {
        $name = trim($name);
        Assert::notEmpty($name);
        Assert::maxLength($name, 255);
        $this->name = $name;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $brand = trim($brand);
        Assert::notEmpty($brand);
        Assert::maxLength($brand, 255);
        $this->brand = $brand;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        Assert::greaterThan($price, 0);
        $this->price = $price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        if (!is_null($description)) {
            $description = trim($description);
            Assert::notEmpty($description);
        }
        $this->description = $description;
    }

    public function isFurniture(): bool
    {
        return $this->code > 980000;
    }
}
