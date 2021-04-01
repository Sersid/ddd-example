<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject\String\StringValueObject;
use Webmozart\Assert\Assert;

class ProductName extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->value = $this->trim()->getValue();
        Assert::notEmpty($this->value);
        Assert::maxLength($this->value, 255);
    }
}
