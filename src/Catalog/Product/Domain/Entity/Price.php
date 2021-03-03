<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\MoneyValueObject;
use Webmozart\Assert\Assert;

class Price extends MoneyValueObject
{
    public function __construct(float $value)
    {
        Assert::greaterThan($value, 0);
        parent::__construct($value);
    }
}
