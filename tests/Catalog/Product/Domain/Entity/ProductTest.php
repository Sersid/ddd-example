<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\Brand;
use App\Catalog\Product\Domain\Entity\Code;
use App\Catalog\Product\Domain\Entity\Description;
use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Price;
use App\Catalog\Product\Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     *
     * @param int         $code
     * @param string      $name
     * @param string      $brand
     * @param float       $price
     * @param string|null $description
     */
    public function testCreate(int $code, string $name, string $brand, float $price, ?string $description)
    {
        $code = new Code($code);
        $name = new Name($name);
        $brand = new Brand($brand);
        $price = new Price($price);
        $description = new Description($description);

        $product = new Product($code, $name, $brand, $price, $description);

        $this->assertSame($code, $product->getCode());
        $this->assertSame($name, $product->getName());
        $this->assertSame($brand, $product->getBrand());
        $this->assertSame($price, $product->getPrice());
        $this->assertSame($description, $product->getDescription());
    }

    public function additionProvider(): array
    {
        return [
            [100001, 'Product name #1', 'Product brand #1', 10, null],
            [100002, 'Product name #2', 'Product brand #2', 20, null],
            [100003, 'Product name #3', 'Product brand #3', 30, null],
            [100003, 'Product name #1', 'Product brand #4', 40, 'Product description #4'],
        ];
    }

    public function testUpdate()
    {
        $product = new Product(
            new Code(123456),
            new Name('Old name'),
            new Brand('Old brand'),
            new Price(123),
            new Description(null)
        );

        $product->setName($name = new Name('New name'));
        $product->setBrand($brand = new Brand('New Brand'));
        $product->setPrice($price = new Price(1000.10));
        $product->setDescription($description = new Description('New description'));

        $this->assertSame($name, $product->getName());
        $this->assertSame($brand, $product->getBrand());
        $this->assertSame($price, $product->getPrice());
        $this->assertSame($description, $product->getDescription());
    }
}
