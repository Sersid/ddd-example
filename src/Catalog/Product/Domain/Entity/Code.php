<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use Webmozart\Assert\Assert;

class Code
{
    private int $value;

    public function __construct(int $value)
    {
        Assert::range($value, 100000, 999999);
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
