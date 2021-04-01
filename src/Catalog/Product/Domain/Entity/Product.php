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

final class Product implements AggregateRoot
{
    use EventTrait;

    private ProductId $id;
    private ProductCode $code;
    private ProductName $name;
    private ProductBrandId $brandId;
    private ProductPrice $price;
    private ProductDescription $description;

    private function __construct()
    {
    }

    public static function create(
        ProductCode $code,
        ProductName $name,
        ProductBrandId $brandId,
        ProductPrice $price,
        ProductDescription $description
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
        $product->id = new ProductId($dto->id);
        $product->code = new ProductCode($dto->code);
        $product->name = new ProductName($dto->name);
        $product->brandId = new ProductBrandId($dto->brandId);
        $product->price = new ProductPrice($dto->price);
        $product->description = new ProductDescription($dto->description);

        return $product;
    }

    public function getId(): ProductId
    {
        return $this->id;
    }

    public function getCode(): ProductCode
    {
        return $this->code;
    }

    public function getName(): ProductName
    {
        return $this->name;
    }

    public function rename(ProductName $name): void
    {
        if ($this->name->isNotEqual($name)) {
            $this->recordEvent(new ProductRenamedEvent($this, $this->name->getValue()));
            $this->name = $name;
        }
    }

    public function getBrandId(): ProductBrandId
    {
        return $this->brandId;
    }

    public function changeBrandId(ProductBrandId $brand): void
    {
        if ($this->brandId->isNotEqual($brand)) {
            $this->recordEvent(new ProductChangedBrandIdEvent($this, $this->brandId->getValue()));
            $this->brandId = $brand;
        }
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    public function changePrice(ProductPrice $price): void
    {
        if ($this->price->isNotEqual($price)) {
            $this->recordEvent(new ProductChangedPriceEvent($this, $this->price->getValue()));
            $this->price = $price;
        }
    }

    public function getDescription(): ProductDescription
    {
        return $this->description;
    }

    public function changeDescription(ProductDescription $description): void
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
