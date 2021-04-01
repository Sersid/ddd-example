<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Domain\Entity;

use App\Catalog\Product\Domain\Entity\BrandId;
use PHPUnit\Framework\TestCase;

class BrandIdTest extends TestCase
{
    public function validAdditionProvider(): array
    {
        return [[null], [1], [100]];
    }

    /**
     * @dataProvider validAdditionProvider
     *
     * @param mixed $value
     */
    public function testValid($value)
    {
        $code = new BrandId($value);
        $this->assertSame($code->getValue(), $value);
    }
}
