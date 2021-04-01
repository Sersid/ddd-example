<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\ProductDescription;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProductDescriptionTest extends TestCase
{
    public function validAdditionProvider(): array
    {
        return [['Test'], ['Тест'], ['T'], [null]];
    }

    /**
     * @dataProvider validAdditionProvider
     *
     * @param mixed $value
     */
    public function testValid($value)
    {
        $code = new ProductDescription($value);
        $this->assertSame($code->getValue(), is_null($value) ? null : trim($value));
    }

    public function invalidAdditionProvider(): array
    {
        return [[''], ['    '], ['   0   ']];
    }

    /**
     * @dataProvider invalidAdditionProvider
     *
     * @param mixed $value
     */
    public function testInvalid($value)
    {
        $this->expectException(InvalidArgumentException::class);
        new ProductDescription($value);
    }
}
