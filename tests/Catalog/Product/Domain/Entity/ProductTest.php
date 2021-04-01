<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Dto\ProductDto;
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
     * @dataProvider additionCreateProvider
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

    public function additionCreateProvider(): array
    {
        return [
            [100001, 'Product name #1', 1, 10, null],
            [100002, 'Product name #2', null, 20, null],
            [100003, 'Product name #3', 1, 30, null],
            [100003, 'Product name #1', 3, 40, 'Product description #4'],
        ];
    }

    /**
     * @dataProvider additionRestoreProvider
     *
     * @param int         $id
     * @param int         $code
     * @param string      $name
     * @param int|null    $brandId
     * @param float       $price
     * @param string|null $description
     */
    public function testRestore(int $id, int $code, string $name, ?int $brandId, float $price, ?string $description)
    {
        $dto = new ProductDto();
        $dto->id = $id;
        $dto->code = $code;
        $dto->name = $name;
        $dto->brandId = $brandId;
        $dto->price = $price;
        $dto->description = $description;

        $product = Product::restore($dto);
        $this->assertSame($dto->id, $product->getId()->getValue());
        $this->assertSame($dto->code, $product->getCode()->getValue());
        $this->assertSame($dto->name, $product->getName()->getValue());
        $this->assertSame($dto->brandId, $product->getBrandId()->getValue());
        $this->assertSame($dto->price, $product->getPrice()->getValue());
        $this->assertSame($dto->description, $product->getDescription()->getValue());
    }

    public function additionRestoreProvider(): array
    {
        return [
            [1, 100001, 'Product name #1', 1, 10, null],
            [3, 100002, 'Product name #2', null, 20, null],
            [100, 100003, 'Product name #3', 1, 30, null],
            [101, 100003, 'Product name #1', 3, 40, 'Product description #4'],
        ];
    }

    public function testUpdate()
    {
        $dto = new ProductDto();
        $dto->id = 1234;
        $dto->code = 123456;
        $dto->name = 'Old name';
        $dto->brandId = 10;
        $dto->price = 100500;
        $dto->description = null;

        $product = Product::restore($dto);

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
