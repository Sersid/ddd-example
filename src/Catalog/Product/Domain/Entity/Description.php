<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use Webmozart\Assert\Assert;

class Description
{
    private ?string $value;

    public function __construct(?string $value)
    {
        if (!is_null($value)) {
            $value = trim($value);
            Assert::notEmpty($value);
        }

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
