<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

class Product
{
    private Id $id;
    private Code $code;
    private Name $name;
    private Brand $brand;
    private Price $price;
    private Description $description;

    public function __construct(Code $code, Name $name, Brand $brand, Price $price, Description $description)
    {
        $this->code = $code;
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->description = $description;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getCode(): Code
    {
        return $this->code;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function rename(Name $name): void
    {
        if (!$this->name->equalTo($name)) {
            $this->name = $name;
        }
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function changeBrand(Brand $brand): void
    {
        if (!$this->brand->equalTo($brand)) {
            $this->brand = $brand;
        }
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function changePrice(Price $price): void
    {
        if (!$this->price->equalTo($price)) {
            $this->price = $price;
        }
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function changeDescription(Description $description): void
    {
        if (!$this->description->equalTo($description)) {
            $this->description = $description;
        }
    }

    public function isFurniture(): bool
    {
        return $this->code->isFurniture();
    }
}
