<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\ProductPrice;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProductPriceTest extends TestCase
{
    public function validAdditionProvider(): array
    {
        return [[0.01], [25], [100500.100500]];
    }

    /**
     * @dataProvider validAdditionProvider
     *
     * @param mixed $value
     */
    public function testValid($value)
    {
        $code = new ProductPrice($value);
        $this->assertSame($code->getValue(), (float)$value);
    }

    public function invalidAdditionProvider(): array
    {
        return [[-1], [0]];
    }

    /**
     * @dataProvider invalidAdditionProvider
     *
     * @param mixed $value
     */
    public function testInvalid($value)
    {
        $this->expectException(InvalidArgumentException::class);
        new ProductPrice($value);
    }
}
