<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject;
use Webmozart\Assert\Assert;

class Description extends ValueObject
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

    public function getValue(): ?string
    {
        return $this->value;
    }
}
