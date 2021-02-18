<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\StringValueObject;
use Webmozart\Assert\Assert;

class Name extends StringValueObject
{
    public function __construct(string $value)
    {
        $value = trim($value);
        Assert::notEmpty($value);
        Assert::maxLength($value, 255);
        parent::__construct($value);
    }
}
