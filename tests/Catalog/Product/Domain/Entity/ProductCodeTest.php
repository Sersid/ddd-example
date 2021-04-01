<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\ProductCode;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProductCodeTest extends TestCase
{
    public function validAdditionProvider(): array
    {
        return [[100001], [970000], [100000], [123123], [123456]];
    }

    /**
     * @dataProvider validAdditionProvider
     *
     * @param mixed $value
     */
    public function testValid($value)
    {
        $code = new ProductCode($value);
        $this->assertSame($code->getValue(), $value);
        $this->assertFalse($code->isFurniture());
    }

    public function invalidAdditionProvider(): array
    {
        return [[-1], [10000], [99999], [9999999], [1000000], [0]];
    }

    /**
     * @dataProvider invalidAdditionProvider
     *
     * @param mixed $value
     */
    public function testInvalid($value)
    {
        $this->expectException(InvalidArgumentException::class);
        new ProductCode($value);
    }
}
