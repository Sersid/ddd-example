<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

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

    public function __construct(Code $code, Name $name, BrandId $brandId, Price $price, Description $description)
    {
        $this->code = $code;
        $this->name = $name;
        $this->brandId = $brandId;
        $this->price = $price;
        $this->description = $description;
    }

    public static function create(Code $code, Name $name, BrandId $brandId, Price $price, Description $description): self
    {
        $self = new self($code, $name, $brandId, $price, $description);
        $self->recordEvent(new ProductCreatedEvent($self));

        return $self;
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
            $this->recordEvent(new ProductRenamedEvent($this, $this->name));
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
            $this->recordEvent(new ProductChangedBrandIdEvent($this, $this->brandId));
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
            $this->recordEvent(new ProductChangedPriceEvent($this, $this->price));
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
