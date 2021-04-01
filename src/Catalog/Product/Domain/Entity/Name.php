<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject\String\StringValueObject;
use Webmozart\Assert\Assert;

class Name extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        Assert::notEmpty($this->value);
        Assert::maxLength($this->value, 255);
    }
}
