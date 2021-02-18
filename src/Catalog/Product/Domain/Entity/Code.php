<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\IntValueObject;
use Webmozart\Assert\Assert;

class Code extends IntValueObject
{
    public function __construct(int $value)
    {
        Assert::range($value, 100000, 999999);
        parent::__construct($value);
    }

    public function isFurniture(): bool
    {
        return $this->value > 980000;
    }
}
