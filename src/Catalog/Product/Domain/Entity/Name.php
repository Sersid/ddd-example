<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use Webmozart\Assert\Assert;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);
        Assert::notEmpty($value);
        Assert::maxLength($value, 255);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
