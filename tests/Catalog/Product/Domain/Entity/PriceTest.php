<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\Price;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
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
        $code = new Price($value);
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
        new Price($value);
    }

    public function formattedAdditionProvider(): array
    {
        return [
            [1, '1'],
            [1333444, '1 333 444'],
            [1.1, '1.10'],
            [10.1, '10.10'],
            [100.15, '100.15'],
            [1000.15, '1 000.15'],
            [1000.15123, '1 000.15'],
            [1000.15999, '1 000.15'],
            [100500.15999, '100 500.15'],
            [1234567890.15999, '1 234 567 890.16'],
        ];
    }

    /**
     * @dataProvider formattedAdditionProvider
     *
     * @param float  $value
     * @param string $wait
     */
    public function testFormatted(float $value, string $wait)
    {
        $price = new Price($value);
        $this->assertSame($price->getFormatted(), $wait);
    }
}
