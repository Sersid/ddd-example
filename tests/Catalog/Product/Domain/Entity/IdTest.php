<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\Id;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IdTest extends TestCase
{
    public function validAdditionProvider(): array
    {
        return [[1], [5], [123], [10000], [111111]];
    }

    /**
     * @dataProvider validAdditionProvider
     *
     * @param int $value
     */
    public function testValid(int $value)
    {
        $code = new Id($value);
        $this->assertSame($code->getValue(), $value);
    }

    public function invalidAdditionProvider(): array
    {
        return [[-1], [0]];
    }

    /**
     * @dataProvider invalidAdditionProvider
     *
     * @param int $value
     */
    public function testInvalid(int $value)
    {
        $this->expectException(InvalidArgumentException::class);
        new Id($value);
    }
}
