<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject\String\StringNullableValueObject;
use Webmozart\Assert\Assert;

class ProductDescription extends StringNullableValueObject
{
    public function __construct(?string $value)
    {
        if (!is_null($value)) {
            $value = trim($value);
            Assert::notEmpty($value);
        }
        parent::__construct($value);
    }
}
