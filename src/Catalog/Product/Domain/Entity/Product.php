<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Dto\ProductDto;
use App\Catalog\Product\Domain\Event\ProductChangedBrandIdEvent;
use App\Catalog\Product\Domain\Event\ProductChangedPriceEvent;
use App\Catalog\Product\Domain\Event\ProductCreatedEvent;
use App\Catalog\Product\Domain\Event\ProductRenamedEvent;
use App\Kernel\Domain\Event\AggregateRoot;
use App\Kernel\Domain\Event\EventTrait;

class Product implements AggregateRoot
{
    use EventTrait;

    private Id $id;
    private Code $code;
    private Name $name;
    private BrandId $brandId;
    private Price $price;
    private Description $description;

    private function __construct()
    {
    }

    public static function create(
        Code $code,
        Name $name,
        BrandId $brandId,
        Price $price,
        Description $description
    ): self {
        $product = new self();
        $product->code = $code;
        $product->name = $name;
        $product->brandId = $brandId;
        $product->price = $price;
        $product->description = $description;

        $product->recordEvent(new ProductCreatedEvent($product));

        return $product;
    }

    // load, open, fromDto and etc
    public static function restore(ProductDto $dto): self
    {
        $product = new self();
        $product->id = new Id($dto->id);
        $product->code = new Code($dto->code);
        $product->name = new Name($dto->name);
        $product->brandId = new BrandId($dto->brandId);
        $product->price = new Price($dto->price);
        $product->description = new Description($dto->description);

        return $product;
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
        if ($this->name->isNotEqual($name)) {
            $this->recordEvent(new ProductRenamedEvent($this, $this->name->getValue()));
            $this->name = $name;
        }
    }

    public function getBrandId(): BrandId
    {
        return $this->brandId;
    }

    public function changeBrandId(BrandId $brand): void
    {
        if ($this->brandId->isNotEqual($brand)) {
            $this->recordEvent(new ProductChangedBrandIdEvent($this, $this->brandId->getValue()));
            $this->brandId = $brand;
        }
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function changePrice(Price $price): void
    {
        if ($this->price->isNotEqual($price)) {
            $this->recordEvent(new ProductChangedPriceEvent($this, $this->price->getValue()));
            $this->price = $price;
        }
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function changeDescription(Description $description): void
    {
        if ($this->description->isNotEqual($description)) {
            $this->description = $description;
        }
    }

    public function isFurniture(): bool
    {
        return $this->code->isFurniture();
    }
}
