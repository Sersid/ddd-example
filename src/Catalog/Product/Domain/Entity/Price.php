<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use Webmozart\Assert\Assert;

class Price
{
    private float $value;

    public function __construct(float $value)
    {
        Assert::greaterThan($value, 0);
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
