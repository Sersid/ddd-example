<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\Name;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function validAdditionProvider(): array
    {
        return [['Test'], ['Тест'], ['T']];
    }

    /**
     * @dataProvider validAdditionProvider
     *
     * @param mixed $value
     */
    public function testValid($value)
    {
        $code = new Name($value);
        $this->assertSame($code->getValue(), trim($value));
    }

    public function invalidAdditionProvider(): array
    {
        return [[''], ['    '], ['   0   '], [str_repeat('A', 256)]];
    }

    /**
     * @dataProvider invalidAdditionProvider
     *
     * @param mixed $value
     */
    public function testInvalid($value)
    {
        $this->expectException(InvalidArgumentException::class);
        new Name($value);
    }
}
