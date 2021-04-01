<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\ProductName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProductNameTest extends TestCase
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
        $code = new ProductName($value);
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
        new ProductName($value);
    }
    
    public function testStringFunction()
    {
        $value = '<p>Product name</p>';
        $name = new Name($value);
        $lowerName = $name->toUpper();
        $htmlEntitiesName = $lowerName->htmlEntities();
        
        $this->assertSame($name->getValue(), $value);
        $this->assertSame($lowerName->getValue(), mb_strtoupper($value));
        $this->assertSame($htmlEntitiesName->getValue(), htmlentities(mb_strtoupper($value)));
    }
}
