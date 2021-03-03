<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject\String\StringNullableValueObject;
use Webmozart\Assert\Assert;

class Description extends StringNullableValueObject
{
    public function __construct(?string $value)
    {
        parent::__construct($value);
        if ($this->isNotNull()) {
            $this->value = $this->trim()->getValue();
            Assert::notEmpty($this->value);
        }
    }
}
