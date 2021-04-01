<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject\Float\FloatValueObject;
use Webmozart\Assert\Assert;

class Price extends FloatValueObject
{
    public function __construct(float $value)
    {
        Assert::greaterThan($value, 0);
        parent::__construct($value);
    }
}
