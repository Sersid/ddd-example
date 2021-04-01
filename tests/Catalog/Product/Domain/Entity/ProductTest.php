<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\BrandId;
use App\Catalog\Product\Domain\Entity\Code;
use App\Catalog\Product\Domain\Entity\Description;
use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Price;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Event\ProductChangedBrandIdEvent;
use App\Catalog\Product\Domain\Event\ProductChangedPriceEvent;
use App\Catalog\Product\Domain\Event\ProductCreatedEvent;
use App\Catalog\Product\Domain\Event\ProductRenamedEvent;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     *
     * @param int         $code
     * @param string      $name
     * @param int|null    $brandId
     * @param float       $price
     * @param string|null $description
     */
    public function testCreate(int $code, string $name, ?int $brandId, float $price, ?string $description)
    {
        $code = new Code($code);
        $name = new Name($name);
        $brandId = new BrandId($brandId);
        $price = new Price($price);
        $description = new Description($description);

        $product = Product::create($code, $name, $brandId, $price, $description);

        $this->assertSame($code, $product->getCode());
        $this->assertSame($name, $product->getName());
        $this->assertSame($brandId, $product->getBrandId());
        $this->assertSame($price, $product->getPrice());
        $this->assertSame($description, $product->getDescription());

        $events = $product->releaseEvents();
        $this->assertCount(1, $events);
        $this->assertInstanceOf(ProductCreatedEvent::class, $events[0]);
    }

    public function additionProvider(): array
    {
        return [
            [100001, 'Product name #1', 1, 10, null],
            [100002, 'Product name #2', null, 20, null],
            [100003, 'Product name #3', 1, 30, null],
            [100003, 'Product name #1', 3, 40, 'Product description #4'],
        ];
    }

    public function testUpdate()
    {
        $product = new Product(
            new Code(123456),
            new Name('Old name'),
            new BrandId(10),
            new Price(123),
            new Description(null)
        );

        $product->rename($name = new Name('New name'));
        $product->changeBrandId($brandId = new BrandId(null));
        $product->changePrice($price = new Price(1000.10));
        $product->changeDescription($description = new Description('New description'));

        $this->assertSame($name, $product->getName());
        $this->assertSame($brandId, $product->getBrandId());
        $this->assertSame($price, $product->getPrice());
        $this->assertSame($description, $product->getDescription());

        $events = $product->releaseEvents();
        $this->assertCount(3, $events);
        $this->assertInstanceOf(ProductRenamedEvent::class, $events[0]);
        $this->assertInstanceOf(ProductChangedBrandIdEvent::class, $events[1]);
        $this->assertInstanceOf(ProductChangedPriceEvent::class, $events[2]);
    }
}
